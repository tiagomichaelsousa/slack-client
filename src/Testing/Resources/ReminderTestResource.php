<?php

namespace Slack\Testing\Resources;

use DateTime;
use Carbon\Carbon;
use Slack\Resources\Reminder;
use Slack\Testing\Resources\Concerns\Testable;
use Slack\Contracts\Resources\ReminderContract;
use Slack\Responses\Reminder\AddReminderResponse;
use Slack\Responses\Reminder\ReminderInfoResponse;
use Slack\Responses\Reminder\ListRemindersResponse;
use Slack\Responses\Reminder\DeleteReminderResponse;
use Slack\Responses\Reminder\CompleteReminderResponse;

final class ReminderTestResource implements ReminderContract
{
    use Testable;

    protected function resource(): string
    {
        return Reminder::class;
    }

    public function add(string $text, DateTime $date, array $parameters = []): AddReminderResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'text' => $text, 'time' => (string) Carbon::instance($date)->getTimestamp()]);
    }

    public function complete(string $reminder, array $parameters = []): CompleteReminderResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'reminder' => $reminder]);
    }

    public function delete(string $reminder, array $parameters = []): DeleteReminderResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'reminder' => $reminder]);
    }

    public function info(string $reminder, array $parameters = []): ReminderInfoResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'reminder' => $reminder]);
    }

    public function list(array $parameters = []): ListRemindersResponse
    {
        return $this->record(__FUNCTION__, $parameters);
    }
}
