<?php

declare(strict_types=1);

namespace Slack\Responses\Common;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{next_cursor: string}>
 */
final class ResponseMetadata implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{next_cursor: string}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $nextCursor,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{next_cursor: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['next_cursor'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'next_cursor' => $this->nextCursor,
        ];
    }
}
