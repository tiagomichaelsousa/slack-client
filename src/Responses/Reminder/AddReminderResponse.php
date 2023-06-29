<?php

declare(strict_types=1);

namespace Slack\Responses\Reminder;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;
use Slack\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{ok: bool, reminder: array{id: string, creator: string, user: string, text: string, recurring: bool, time: ?int, complete_ts: ?int}}>
 */
final class AddReminderResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{ok: bool, reminder: array{id: string, creator: string, user: string, text: string, recurring: bool, time: ?int, complete_ts: ?int}}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly bool $ok,
        public readonly Reminder $reminder,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{ok: bool, reminder: array{id: string, creator: string, user: string, text: string, recurring: bool, time: ?int, complete_ts: ?int}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['ok'],
            Reminder::from($attributes['reminder'])
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'ok' => $this->ok,
            'reminder' => $this->reminder->toArray(),
        ];
    }
}
