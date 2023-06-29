<?php

declare(strict_types=1);

namespace Slack\Responses\Conversation;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{value: string, creator: string, last_set: int}>
 */
final class ChannelPurpose implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{value: string, creator: string, last_set: int}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $value,
        public readonly string $creator,
        public readonly int $lastSet,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{value: string, creator: string, last_set: int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['value'],
            $attributes['creator'],
            $attributes['last_set'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'creator' => $this->creator,
            'last_set' => $this->lastSet,
        ];
    }
}
