<?php

use Slack\Responses\Reminder\DeleteReminderResponse;
use Slack\Testing\Responses\Fixtures\Reminder\DeleteReminderResponseFixture;

test('from', function () {
    $response = DeleteReminderResponse::from($fixture = DeleteReminderResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(DeleteReminderResponse::class)
        ->ok->toBe($response->ok)->toBeBool();
});

test('as array accessible', function () {
    $response = DeleteReminderResponse::from($fixture = DeleteReminderResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($fixture['ok']);
});

test('to array', function () {
    $response = DeleteReminderResponse::from($fixture = DeleteReminderResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = DeleteReminderResponse::fake();

    expect($response->ok)
        ->toBe(DeleteReminderResponseFixture::ATTRIBUTES['ok']);
});

test('fake with override', function () {
    $response = DeleteReminderResponse::fake([
        'ok' => false,
    ]);

    expect($response)->ok->toBeFalsy();
});
