<?php

use Slack\Responses\Reminder\Reminder;
use Slack\Responses\Reminder\AddReminderResponse;
use Slack\Testing\Responses\Fixtures\Reminder\AddReminderResponseFixture;

test('from', function () {
    $response = AddReminderResponse::from($fixture = AddReminderResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(AddReminderResponse::class)
        ->ok->toBe($response->ok)->toBeBool()
        ->reminder->toBeInstanceOf(Reminder::class);
});

test('as array accessible', function () {
    $response = AddReminderResponse::from($fixture = AddReminderResponseFixture::ATTRIBUTES);

    expect($response['reminder']['id'])->toBe($fixture['reminder']['id']);
});

test('to array', function () {
    $response = AddReminderResponse::from($fixture = AddReminderResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = AddReminderResponse::fake();

    expect($response->reminder)
        ->id->toBe(AddReminderResponseFixture::ATTRIBUTES['reminder']['id']);
});

test('fake with override', function () {
    $response = AddReminderResponse::fake([
        'reminder' => [
            'id' => 'foo',
        ],
    ]);

    expect($response)->reminder->id->toBe('foo');
});
