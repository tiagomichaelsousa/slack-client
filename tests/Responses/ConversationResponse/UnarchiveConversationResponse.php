<?php

use Slack\Responses\Conversation\UnarchiveConversationResponse;
use Slack\Testing\Responses\Fixtures\Conversation\UnarchiveConversationResponseFixture;

test('from', function () {
    $response = UnarchiveConversationResponse::from($fixture = UnarchiveConversationResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(UnarchiveConversationResponse::class)
        ->ok->toBe($response->ok)->toBeBool();
});

test('as array accessible', function () {
    $response = UnarchiveConversationResponse::from($fixture = UnarchiveConversationResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($fixture['ok']);
});

test('to array', function () {
    $response = UnarchiveConversationResponse::from($fixture = UnarchiveConversationResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = UnarchiveConversationResponse::fake();

    expect($response->ok)
        ->toBe(UnarchiveConversationResponseFixture::ATTRIBUTES['ok']);
});

test('fake with override', function () {
    $response = UnarchiveConversationResponse::fake([
        'ok' => false,
    ]);

    expect($response)->ok->toBeFalsy();
});
