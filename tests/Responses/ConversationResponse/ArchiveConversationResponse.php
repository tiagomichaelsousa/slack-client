<?php

use Slack\Responses\Conversation\ArchiveConversationResponse;
use Slack\Testing\Responses\Fixtures\Conversation\ArchiveConversationResponseFixture;

test('from', function () {
    $response = ArchiveConversationResponse::from($fixture = ArchiveConversationResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(ArchiveConversationResponse::class)
        ->ok->toBe($response->ok)->toBeBool();
});

test('as array accessible', function () {
    $response = ArchiveConversationResponse::from($fixture = ArchiveConversationResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($fixture['ok']);
});

test('to array', function () {
    $response = ArchiveConversationResponse::from($fixture = ArchiveConversationResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = ArchiveConversationResponse::fake();

    expect($response->ok)
        ->toBe(ArchiveConversationResponseFixture::ATTRIBUTES['ok']);
});

test('fake with override', function () {
    $response = ArchiveConversationResponse::fake([
        'ok' => false,
    ]);

    expect($response)->ok->toBeFalsy();
});
