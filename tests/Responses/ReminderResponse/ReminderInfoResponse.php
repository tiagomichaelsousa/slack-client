<?php

use Slack\Responses\Reminder\Reminder;
use Slack\Responses\Reminder\ReminderInfoResponse;
use Slack\Testing\Responses\Fixtures\Reminder\ReminderInfoResponseFixture;

test('from', function () {
    $response = ReminderInfoResponse::from($fixture = ReminderInfoResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(ReminderInfoResponse::class)
        ->ok->toBe($response->ok)->toBeBool()
        ->reminder->toBeInstanceOf(Reminder::class);
});

test('as array accessible', function () {
    $response = ReminderInfoResponse::from($fixture = ReminderInfoResponseFixture::ATTRIBUTES);

    expect($response['reminder']['id'])->toBe($fixture['reminder']['id']);
});

test('to array', function () {
    $response = ReminderInfoResponse::from($fixture = ReminderInfoResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = ReminderInfoResponse::fake();

    expect($response->reminder)
        ->id->toBe(ReminderInfoResponseFixture::ATTRIBUTES['reminder']['id']);
});

test('fake with override', function () {
    $response = ReminderInfoResponse::fake([
        'reminder' => [
            'id' => 'foo',
        ],
    ]);

    expect($response)->reminder->id->toBe('foo');
});
