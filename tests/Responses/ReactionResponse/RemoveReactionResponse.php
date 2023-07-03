<?php

use Slack\Responses\Reaction\RemoveReactionResponse;
use Slack\Testing\Responses\Fixtures\Reaction\RemoveReactionResponseFixture;

test('from', function () {
    $response = RemoveReactionResponse::from($fixture = RemoveReactionResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(RemoveReactionResponse::class)
        ->ok->toBe($fixture['ok'])->toBeBool();
});

test('as array accessible', function () {
    $response = RemoveReactionResponse::from($fixture = RemoveReactionResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($fixture['ok']);
});

test('to array', function () {
    $response = RemoveReactionResponse::from($fixture = RemoveReactionResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = RemoveReactionResponse::fake();

    expect($response)
        ->ok->toBe(RemoveReactionResponseFixture::ATTRIBUTES['ok']);
});

test('fake with override', function () {
    $response = RemoveReactionResponse::fake([
        'ok' => false,
    ]);

    expect($response)->ok->toBeFalsy();
});
