<?php

namespace Slack\Contracts\Resources;

use DateTime;
use Slack\Responses\Reminder\AddReminderResponse;
use Slack\Responses\Reminder\ReminderInfoResponse;
use Slack\Responses\Reminder\ListRemindersResponse;
use Slack\Responses\Reminder\DeleteReminderResponse;
use Slack\Responses\Reminder\CompleteReminderResponse;

interface ReminderContract
{
    /**
     * Creates a reminder.
     *
     * @see https://api.slack.com/methods/reminders.add
     *
     * @param  array<string, mixed>  $parameters
     */
    public function add(string $text, DateTime $date, array $parameters = []): AddReminderResponse;

    /**
     * Marks a reminder as complete.
     *
     * @see https://api.slack.com/methods/reminders.complete
     *
     * @param  array<string, mixed>  $parameters
     */
    public function complete(string $reminder, array $parameters = []): CompleteReminderResponse;

    /**
     * Deletes a reminder.
     *
     * @see https://api.slack.com/methods/reminders.delete
     *
     * @param  array<string, mixed>  $parameters
     */
    public function delete(string $reminder, array $parameters = []): DeleteReminderResponse;

    /**
     * Gets information about a reminder.
     *
     * @see https://api.slack.com/methods/reminders.info
     *
     * @param  array<string, mixed>  $parameters
     */
    public function info(string $reminder, array $parameters = []): ReminderInfoResponse;

    /**
     * Lists all reminders created by or for a given user.
     *
     * @see https://api.slack.com/methods/reminders.list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): ListRemindersResponse;
}
