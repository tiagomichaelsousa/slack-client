<?php

declare(strict_types=1);

namespace Slack\Resources;

use DateTime;
use Carbon\Carbon;
use Slack\ValueObjects\Transporter\Payload;
use Slack\Contracts\Resources\ReminderContract;
use Slack\Responses\Reminder\AddReminderResponse;
use Slack\Responses\Reminder\ReminderInfoResponse;
use Slack\Responses\Reminder\ListRemindersResponse;
use Slack\Responses\Reminder\DeleteReminderResponse;
use Slack\Responses\Reminder\CompleteReminderResponse;

final class Reminder implements ReminderContract
{
    use Concerns\Transportable;

    /**
     * Creates a reminder.
     *
     * @see https://api.slack.com/methods/reminders.add
     *
     * @param  array<string, mixed>  $parameters
     */
    public function add(string $text, DateTime $date, array $parameters = []): AddReminderResponse
    {
        $payload = Payload::post('reminders.add', [...$parameters, 'text' => $text, 'time' => (string) Carbon::instance($date)->getTimestamp()]);

        /** @var array{ok: bool, reminder: array{id: string, creator: string, user: string, text: string, recurring: bool, time: ?int, complete_ts: ?int}} $result */
        $result = $this->transporter->requestObject($payload);

        return AddReminderResponse::from($result);
    }

    /**
     * Marks a reminder as complete.
     *
     * @see https://api.slack.com/methods/reminders.complete
     *
     * @param  array<string, mixed>  $parameters
     */
    public function complete(string $reminder, array $parameters = []): CompleteReminderResponse
    {
        $payload = Payload::post('reminders.complete', [...$parameters, 'reminder' => $reminder]);

        /** @var array{ok: bool} $result */
        $result = $this->transporter->requestObject($payload);

        return CompleteReminderResponse::from($result);
    }

    /**
     * Deletes a reminder.
     *
     * @see https://api.slack.com/methods/reminders.delete
     *
     * @param  array<string, mixed>  $parameters
     */
    public function delete(string $reminder, array $parameters = []): DeleteReminderResponse
    {
        $payload = Payload::post('reminders.delete', [...$parameters, 'reminder' => $reminder]);

        /** @var array{ok: bool} $result */
        $result = $this->transporter->requestObject($payload);

        return DeleteReminderResponse::from($result);
    }

    /**
     * Gets information about a reminder.
     *
     * @see https://api.slack.com/methods/reminders.info
     *
     * @param  array<string, mixed>  $parameters
     */
    public function info(string $reminder, array $parameters = []): ReminderInfoResponse
    {
        $payload = Payload::get('reminders.info', [...$parameters, 'reminder' => $reminder]);

        /** @var array{ok: bool, reminder: array{id: string, creator: string, user: string, text: string, recurring: bool, time: ?int, complete_ts: ?int}} $result */
        $result = $this->transporter->requestObject($payload);

        return ReminderInfoResponse::from($result);
    }

    /**
     * Lists all reminders created by or for a given user.
     *
     * @see https://api.slack.com/methods/reminders.list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): ListRemindersResponse
    {
        $payload = Payload::get('reminders.list', $parameters);

        /** @var array{ok: bool, reminders: array<int, array{id: string, creator: string, user: string, text: string, recurring: bool, time: ?int, complete_ts: ?int}>} $result */
        $result = $this->transporter->requestObject($payload);

        return ListRemindersResponse::from($result);
    }
}
