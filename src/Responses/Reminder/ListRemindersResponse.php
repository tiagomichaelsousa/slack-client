<?php

declare(strict_types=1);

namespace Slack\Responses\Reminder;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;
use Slack\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{ok: bool, reminders: array<int, array{id: string, creator: string, user: string, text: string, recurring: bool, time: ?int, complete_ts: ?int}>}>
 */
final class ListRemindersResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{ok: bool, reminders: array<int, array{id: string, creator: string, user: string, text: string, recurring: bool, time: ?int, complete_ts: ?int}>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, Reminder>  $reminders
     */
    private function __construct(
        public readonly bool $ok,
        public readonly array $reminders,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{ok: bool, reminders: array<int, array{id: string, creator: string, user: string, text: string, recurring: bool, time: ?int, complete_ts: ?int}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $reminders = array_map(fn (array $reminder): Reminder => Reminder::from(
            $reminder
        ), $attributes['reminders']);

        return new self(
            $attributes['ok'],
            $reminders,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'ok' => $this->ok,
            'reminders' => array_map(
                static fn (Reminder $reminder): array => $reminder->toArray(),
                $this->reminders,
            ),
        ];
    }
}
