<?php

declare(strict_types=1);

namespace Slack\Responses\Reaction;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{type: string, text: string, user: string, ts: string, team: string, reactions: array<int, array{name: string, users: array<int, string>, count: int}>, permalink: string}>
 */
final class Message implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: string, text: string, user: string, ts: string, team: string, reactions: array<int, array{name: string, users: array<int, string>, count: int}>, permalink: string}>
     */
    use ArrayAccessible;

    /**
     * @param  array<int, Reaction>  $reactions
     */
    private function __construct(
        public readonly string $type,
        public readonly string $text,
        public readonly string $user,
        public readonly string $ts,
        public readonly string $team,
        public readonly array $reactions,
        public readonly string $permalink,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{type: string, text: string, user: string, ts: string, team: string, reactions: array<int, array{name: string, users: array<int, string>, count: int}>, permalink: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        $reactions = array_map(fn (array $reaction): Reaction => Reaction::from(
            $reaction
        ), $attributes['reactions']);

        return new self(
            $attributes['type'],
            $attributes['text'],
            $attributes['user'],
            $attributes['ts'],
            $attributes['team'],
            $reactions,
            $attributes['permalink'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'text' => $this->text,
            'user' => $this->user,
            'ts' => $this->ts,
            'team' => $this->team,
            'reactions' => array_map(
                static fn (Reaction $reaction): array => $reaction->toArray(),
                $this->reactions,
            ),
            'permalink' => $this->permalink,
        ];
    }
}
