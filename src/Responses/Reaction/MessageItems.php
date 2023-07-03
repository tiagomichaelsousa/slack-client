<?php

declare(strict_types=1);

namespace Slack\Responses\Reaction;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{type: string, channel: string, message: array{type: string, text: string, user: string, ts: string, team: string, reactions: array<int, array{name: string, users: array<int, string>, count: int}>, permalink: string}}>
 */
final class MessageItems implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: string, channel: string, message: array{type: string, text: string, user: string, ts: string, team: string, reactions: array<int, array{name: string, users: array<int, string>, count: int}>, permalink: string}}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $type,
        public readonly string $channel,
        public readonly Message $message,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{type: string, channel: string, message: array{type: string, text: string, user: string, ts: string, team: string, reactions: array<int, array{name: string, users: array<int, string>, count: int}>, permalink: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['channel'],
            Message::from($attributes['message']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'channel' => $this->channel,
            'message' => $this->message->toArray(),
        ];
    }
}
