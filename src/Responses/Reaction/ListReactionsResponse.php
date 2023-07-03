<?php

declare(strict_types=1);

namespace Slack\Responses\Reaction;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Common\ResponseMetadata;
use Slack\Responses\Concerns\ArrayAccessible;
use Slack\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{ok: bool, items: array<int, array{type: string, channel: string, message: array{type: string, text: string, user: string, ts: string, team: string, reactions: array<int, array{name: string, users: array<int, string>, count: int}>, permalink: string}}>, response_metadata: array{next_cursor: string}}>
 */
final class ListReactionsResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{ok: bool, items: array<int, array{type: string, channel: string, message: array{type: string, text: string, user: string, ts: string, team: string, reactions: array<int, array{name: string, users: array<int, string>, count: int}>, permalink: string}}>, response_metadata: array{next_cursor: string}}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, MessageItems>  $items
     */
    private function __construct(
        public readonly bool $ok,
        public readonly array $items,
        public readonly ResponseMetadata $responseMetadata,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{ok: bool, items: array<int, array{type: string, channel: string, message: array{type: string, text: string, user: string, ts: string, team: string, reactions: array<int, array{name: string, users: array<int, string>, count: int}>, permalink: string}}>, response_metadata: array{next_cursor: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        $messages = array_map(fn (array $message): MessageItems => MessageItems::from(
            $message
        ), $attributes['items']);

        return new self(
            $attributes['ok'],
            $messages,
            ResponseMetadata::from($attributes['response_metadata']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'ok' => $this->ok,
            'items' => array_map(
                static fn (MessageItems $messages): array => $messages->toArray(),
                $this->items,
            ),
            'response_metadata' => $this->responseMetadata->toArray(),
        ];
    }
}
