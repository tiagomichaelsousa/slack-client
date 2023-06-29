<?php

use Slack\Responses\Reminder\Reminder;
use Slack\Responses\Reminder\ListRemindersResponse;
use Slack\Testing\Responses\Fixtures\Reminder\ListRemindersResponseFixture;

test('from json', function () {
    $response = ListRemindersResponse::from(ListRemindersResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(ListRemindersResponse::class)
        ->ok->toBe($response->ok)->toBeBool()
        ->reminders->toBeArray()->toHaveCount(2)
        ->reminders->each->toBeInstanceOf(Reminder::class);
});

test('as array accessible', function () {
    $response = ListRemindersResponse::from(ListRemindersResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($response->ok);
    expect($response['reminders'][0]['id'])->toBe($response->toArray()['reminders'][0]['id']);
    expect($response['reminders'][0]['text'])->toBe($response->toArray()['reminders'][0]['text']);
});

test('to array', function () {
    $response = ListRemindersResponse::from($fixture = ListRemindersResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = ListRemindersResponse::fake();

    expect($response->reminders[0])
        ->id->toBe(ListRemindersResponseFixture::ATTRIBUTES['reminders'][0]['id']);
});

test('fake with override', function () {
    $response = ListRemindersResponse::fake([
        'reminders' => [
            [
                'id' => 'foo',
            ],
        ],
    ]);

    expect($response['reminders'][0])
        ->id->toBe('foo');
});
