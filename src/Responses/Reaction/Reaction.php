<?php

declare(strict_types=1);

namespace Slack\Responses\Reaction;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{name: string, users: array<int, string>, count: int}>
 */
final class Reaction implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{name: string, users: array<int, string>, count: int}>
     */
    use ArrayAccessible;

    /**
     * @param  array<int, string>  $users
     */
    private function __construct(
        public readonly string $name,
        public readonly array $users,
        public readonly int $count,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{name: string, users: array<int, string>, count: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['name'],
            $attributes['users'],
            $attributes['count'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'users' => $this->users,
            'count' => $this->count,
        ];
    }
}
