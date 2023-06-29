<?php

use Carbon\Carbon;
use Slack\Resources\Reminder;
use Slack\Testing\ClientFake;
use Slack\Responses\Reminder\AddReminderResponse;
use Slack\Responses\Reminder\ReminderInfoResponse;
use Slack\Responses\Reminder\ListRemindersResponse;
use Slack\Responses\Reminder\DeleteReminderResponse;
use Slack\Responses\Reminder\CompleteReminderResponse;

it('allows to create a new reminder', function () {
    $fake = new ClientFake([
        AddReminderResponse::fake(),
    ]);

    $fake->reminders()->add('eat a banana', $date = Carbon::now()->addMinute());

    $fake->assertSent(Reminder::class, function ($method, $parameters) use ($date) {
        return $method === 'add' &&
            $parameters['text'] === 'eat a banana' &&
            $parameters['time'] === (string) Carbon::instance($date)->timestamp;
    });
});

it('allows to complete a reminder', function () {
    $fake = new ClientFake([
        CompleteReminderResponse::fake(),
    ]);

    $fake->reminders()->complete('reminder', [
        'team_id' => 'T12345678',
    ]);

    $fake->assertSent(Reminder::class, function ($method, $parameters) {
        return $method === 'complete' &&
            $parameters['reminder'] === 'reminder' &&
            $parameters['team_id'] === 'T12345678';
    });
});

it('allows to delete a reminder', function () {
    $fake = new ClientFake([
        DeleteReminderResponse::fake(),
    ]);

    $fake->reminders()->delete('reminder', [
        'team_id' => 'T12345678',
    ]);

    $fake->assertSent(Reminder::class, function ($method, $parameters) {
        return $method === 'delete' &&
            $parameters['reminder'] === 'reminder' &&
            $parameters['team_id'] === 'T12345678';
    });
});

it('allows to get a reminder info', function () {
    $fake = new ClientFake([
        ReminderInfoResponse::fake(),
    ]);

    $fake->reminders()->info('reminder', [
        'team_id' => 'T12345678',
    ]);

    $fake->assertSent(Reminder::class, function ($method, $parameters) {
        return $method === 'info' &&
            $parameters['reminder'] === 'reminder' &&
            $parameters['team_id'] === 'T12345678';
    });
});

it('allows to list all the reminders', function () {
    $fake = new ClientFake([
        ListRemindersResponse::fake(),
    ]);

    $fake->reminders()->list([
        'team_id' => 'T12345678',
    ]);

    $fake->assertSent(Reminder::class, function ($method, $parameters) {
        return $method === 'list' &&
            $parameters['team_id'] === 'T12345678';
    });
});
