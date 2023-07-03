<?php

namespace Slack\Testing;

use Throwable;
use Slack\Contracts\ClientContract;
use Slack\Responses\StreamResponse;
use Slack\Contracts\ResponseContract;
use Slack\Testing\Requests\TestRequest;
use PHPUnit\Framework\Assert as PHPUnit;
use Slack\Testing\Resources\UserTestResource;
use Slack\Testing\Resources\ReactionTestResource;
use Slack\Testing\Resources\ReminderTestResource;
use Slack\Testing\Resources\ConversationTestResource;

class ClientFake implements ClientContract
{
    /**
     * @var array<array-key, TestRequest>
     */
    private array $requests = [];

    /**
     * @param  array<array-key, ResponseContract|StreamResponse|string>  $responses
     */
    public function __construct(protected array $responses = [])
    {
    }

    /**
     * @param  array<array-key, Response>  $responses
     */
    public function addResponses(array $responses): void
    {
        $this->responses = [...$this->responses, ...$responses];
    }

    public function assertSent(string $resource, callable|int|null $callback = null): void
    {
        if (is_int($callback)) {
            $this->assertSentTimes($resource, $callback);

            return;
        }

        PHPUnit::assertTrue(
            $this->sent($resource, $callback) !== [],
            "The expected [{$resource}] request was not sent."
        );
    }

    public function assertSentTimes(string $resource, int $times = 1): void
    {
        $count = count($this->sent($resource));

        PHPUnit::assertSame(
            $times,
            $count,
            "The expected [{$resource}] resource was sent {$count} times instead of {$times} times."
        );
    }

    /**
     * @return mixed[]
     */
    private function sent(string $resource, callable $callback = null): array
    {
        if (! $this->hasSent($resource)) {
            return [];
        }

        $callback = $callback ?: fn (): bool => true;

        return array_filter($this->resourcesOf($resource), fn (TestRequest $resource) => $callback($resource->method(), $resource->parameters()));
    }

    private function hasSent(string $resource): bool
    {
        return $this->resourcesOf($resource) !== [];
    }

    public function assertNotSent(string $resource, callable $callback = null): void
    {
        PHPUnit::assertCount(
            0,
            $this->sent($resource, $callback),
            "The unexpected [{$resource}] request was sent."
        );
    }

    public function assertNothingSent(): void
    {
        $resourceNames = implode(
            separator: ', ',
            array: array_map(fn (TestRequest $request): string => $request->resource(), $this->requests)
        );

        PHPUnit::assertEmpty($this->requests, 'The following requests were sent unexpectedly: '.$resourceNames);
    }

    /**
     * @return array<array-key, TestRequest>
     */
    private function resourcesOf(string $type): array
    {
        return array_filter($this->requests, fn (TestRequest $request): bool => $request->resource() === $type);
    }

    public function record(TestRequest $request): ResponseContract|string
    {
        $this->requests[] = $request;

        $response = array_shift($this->responses);

        if (is_null($response)) {
            throw new \Exception('No fake responses left.');
        }

        if ($response instanceof Throwable) {
            throw $response;
        }

        return $response;
    }

    public function users(): UserTestResource
    {
        return new UserTestResource($this);
    }

    public function conversations(): ConversationTestResource
    {
        return new ConversationTestResource($this);
    }

    public function reminders(): ReminderTestResource
    {
        return new ReminderTestResource($this);
    }

    public function reactions(): ReactionTestResource
    {
        return new ReactionTestResource($this);
    }
}
