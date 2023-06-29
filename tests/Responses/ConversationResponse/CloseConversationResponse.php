<?php

use Slack\Responses\Conversation\CloseConversationResponse;
use Slack\Testing\Responses\Fixtures\Conversation\CloseConversationResponseFixture;

test('from', function () {
    $response = CloseConversationResponse::from($fixture = CloseConversationResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(CloseConversationResponse::class)
        ->ok->toBe($response->ok)->toBeBool();
});

test('as array accessible', function () {
    $response = CloseConversationResponse::from($fixture = CloseConversationResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($fixture['ok']);
});

test('to array', function () {
    $response = CloseConversationResponse::from($fixture = CloseConversationResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = CloseConversationResponse::fake();

    expect($response->ok)
        ->toBe(CloseConversationResponseFixture::ATTRIBUTES['ok']);
});

test('fake with override', function () {
    $response = CloseConversationResponse::fake([
        'ok' => false,
    ]);

    expect($response)->ok->toBeFalsy();
});
