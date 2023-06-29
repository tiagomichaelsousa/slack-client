<?php

use Carbon\Carbon;
use Slack\Responses\Reminder\Reminder;
use Slack\Responses\Reminder\AddReminderResponse;
use Slack\Responses\Reminder\ReminderInfoResponse;
use Slack\Responses\Reminder\ListRemindersResponse;
use Slack\Responses\Reminder\DeleteReminderResponse;
use Slack\Responses\Reminder\CompleteReminderResponse;

test('add', function () {
    $fake = AddReminderResponse::fake();
    $client = mockClient('POST', 'reminders.add', [], $fake->toArray());

    $result = $client->reminders()->add('text', Carbon::now());

    expect($result)
        ->toBeInstanceOf(AddReminderResponse::class)
        ->ok->toBeTruthy()
        ->reminder->toBeInstanceOf(Reminder::class);
});

test('complete', function () {
    $fake = CompleteReminderResponse::fake();
    $client = mockClient('POST', 'reminders.complete', [], $fake->toArray());

    $result = $client->reminders()->complete('reminder');

    expect($result)
        ->toBeInstanceOf(CompleteReminderResponse::class)
        ->ok->toBeTruthy();
});

test('delete', function () {
    $fake = DeleteReminderResponse::fake();
    $client = mockClient('POST', 'reminders.delete', [], $fake->toArray());

    $result = $client->reminders()->delete('reminder');

    expect($result)
        ->toBeInstanceOf(DeleteReminderResponse::class)
        ->ok->toBeTruthy();
});

test('info', function () {
    $fake = ReminderInfoResponse::fake();
    $client = mockClient('GET', 'reminders.info', [], $fake->toArray());

    $result = $client->reminders()->info('reminder');

    expect($result)
        ->toBeInstanceOf(ReminderInfoResponse::class)
        ->ok->toBeTruthy()
        ->reminder->toBeInstanceOf(Reminder::class);
});

test('list', function () {
    $fake = ListRemindersResponse::fake();
    $client = mockClient('GET', 'reminders.list', [], $fake->toArray());

    $result = $client->reminders()->list();

    expect($result)
        ->toBeInstanceOf(ListRemindersResponse::class)
        ->ok->toBeTruthy()
        ->reminders->toBeArray()->toHaveCount(2)
        ->reminders->each->toBeInstanceOf(Reminder::class);
});
