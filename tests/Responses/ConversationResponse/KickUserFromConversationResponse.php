<?php

use Slack\Responses\Conversation\KickUserFromConversationResponse;
use Slack\Testing\Responses\Fixtures\Conversation\KickUserFromConversationResponseFixture;

test('from', function () {
    $response = KickUserFromConversationResponse::from($fixture = KickUserFromConversationResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(KickUserFromConversationResponse::class)
        ->ok->toBe($response->ok)->toBeBool();
});

test('as array accessible', function () {
    $response = KickUserFromConversationResponse::from($fixture = KickUserFromConversationResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($fixture['ok']);
});

test('to array', function () {
    $response = KickUserFromConversationResponse::from($fixture = KickUserFromConversationResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = KickUserFromConversationResponse::fake();

    expect($response->ok)
        ->toBe(KickUserFromConversationResponseFixture::ATTRIBUTES['ok']);
});

test('fake with override', function () {
    $response = KickUserFromConversationResponse::fake([
        'ok' => false,
    ]);

    expect($response)->ok->toBeFalsy();
});
