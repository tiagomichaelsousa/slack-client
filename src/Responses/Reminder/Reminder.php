<?php

declare(strict_types=1);

namespace Slack\Responses\Reminder;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{id: string, creator: string, user: string, text: string, recurring: bool, time: ?int, complete_ts: ?int}>
 */
final class Reminder implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, creator: string, user: string, text: string, recurring: bool, time: ?int, complete_ts: ?int}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $id,
        public readonly string $creator,
        public readonly string $user,
        public readonly string $text,
        public readonly bool $recurring,
        public readonly ?int $time,
        public readonly ?int $completeTs,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, creator: string, user: string, text: string, recurring: bool, time: ?int, complete_ts: ?int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['creator'],
            $attributes['user'],
            $attributes['text'],
            $attributes['recurring'],
            $attributes['time'] ?? null,
            $attributes['complete_ts'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'creator' => $this->creator,
            'user' => $this->user,
            'text' => $this->text,
            'recurring' => $this->recurring,
            'time' => $this->time,
            'complete_ts' => $this->completeTs,
        ];
    }
}
