<?php

use Slack\Responses\Reminder\CompleteReminderResponse;
use Slack\Testing\Responses\Fixtures\Reminder\CompleteReminderResponseFixture;

test('from', function () {
    $response = CompleteReminderResponse::from($fixture = CompleteReminderResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(CompleteReminderResponse::class)
        ->ok->toBe($response->ok)->toBeBool();
});

test('as array accessible', function () {
    $response = CompleteReminderResponse::from($fixture = CompleteReminderResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($fixture['ok']);
});

test('to array', function () {
    $response = CompleteReminderResponse::from($fixture = CompleteReminderResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = CompleteReminderResponse::fake();

    expect($response->ok)
        ->toBe(CompleteReminderResponseFixture::ATTRIBUTES['ok']);
});

test('fake with override', function () {
    $response = CompleteReminderResponse::fake([
        'ok' => false,
    ]);

    expect($response)->ok->toBeFalsy();
});
