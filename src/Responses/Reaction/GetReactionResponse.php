<?php

declare(strict_types=1);

namespace Slack\Responses\Reaction;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;
use Slack\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{ok: bool, type: string, message: array{type: string, text: string, user: string, ts: string, team: string, reactions: array<int, array{name: string, users: array<int, string>, count: int}>, permalink: string}, channel: string}>
 */
final class GetReactionResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{ok: bool, type: string, message: array{type: string, text: string, user: string, ts: string, team: string, reactions: array<int, array{name: string, users: array<int, string>, count: int}>, permalink: string}, channel: string}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly bool $ok,
        public readonly string $type,
        public readonly Message $message,
        public readonly string $channel,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{ok: bool, type: string, message: array{type: string, text: string, user: string, ts: string, team: string, reactions: array<int, array{name: string, users: array<int, string>, count: int}>, permalink: string}, channel: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['ok'],
            $attributes['type'],
            Message::from($attributes['message']),
            $attributes['channel'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'ok' => $this->ok,
            'type' => $this->type,
            'message' => $this->message->toArray(),
            'channel' => $this->channel,
        ];
    }
}
