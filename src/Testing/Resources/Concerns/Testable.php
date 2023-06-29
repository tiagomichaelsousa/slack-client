<?php

namespace Slack\Testing\Resources\Concerns;

use Slack\Testing\ClientFake;
use Slack\Contracts\ResponseContract;
use Slack\Testing\Requests\TestRequest;

trait Testable
{
    public function __construct(protected ClientFake $fake)
    {
    }

    abstract protected function resource(): string;

    /**
     * @param  array<string, mixed>|string|null  $parameters
     */
    protected function record(string $method, array|string|null $parameters = null): ResponseContract|string
    {
        return $this->fake->record(new TestRequest($this->resource(), $method, $parameters));
    }

    public function assertSent(callable|int|null $callback = null): void
    {
        $this->fake->assertSent($this->resource(), $callback);
    }

    public function assertNotSent(callable|int|null $callback = null): void
    {
        $this->fake->assertNotSent($this->resource(), $callback);
    }
}
