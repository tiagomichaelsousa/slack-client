<?php

use Slack\Responses\Reaction\AddReactionResponse;
use Slack\Testing\Responses\Fixtures\Reaction\AddReactionResponseFixture;

test('from', function () {
    $response = AddReactionResponse::from($fixture = AddReactionResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(AddReactionResponse::class)
        ->ok->toBe($fixture['ok'])->toBeBool();
});

test('as array accessible', function () {
    $response = AddReactionResponse::from($fixture = AddReactionResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($fixture['ok']);
});

test('to array', function () {
    $response = AddReactionResponse::from($fixture = AddReactionResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = AddReactionResponse::fake();

    expect($response)
        ->ok->toBe(AddReactionResponseFixture::ATTRIBUTES['ok']);
});

test('fake with override', function () {
    $response = AddReactionResponse::fake([
        'ok' => false,
    ]);

    expect($response)->ok->toBeFalsy();
});
