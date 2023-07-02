<?php

use Slack\Responses\Reaction\Message;
use Slack\Responses\Reaction\GetReactionResponse;
use Slack\Testing\Responses\Fixtures\Reaction\GetReactionResponseFixture;

test('from', function () {
    $response = GetReactionResponse::from($fixture = GetReactionResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(GetReactionResponse::class)
        ->ok->toBe($fixture['ok'])->toBeBool()
        ->type->toBe($fixture['type'])->toBeString()
        ->message->toBeInstanceOf(Message::class)
        ->channel->toBe($fixture['channel'])->toBeString();
});

test('as array accessible', function () {
    $response = GetReactionResponse::from($fixture = GetReactionResponseFixture::ATTRIBUTES);

    expect($response['message']['reactions'][0]['name'])->toBe($fixture['message']['reactions'][0]['name']);
});

test('to array', function () {
    $response = GetReactionResponse::from($fixture = GetReactionResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = GetReactionResponse::fake();

    expect($response)
        ->type->toBe(GetReactionResponseFixture::ATTRIBUTES['type']);
});

test('fake with override', function () {
    $response = GetReactionResponse::fake([
        'message' => [
            'text' => 'foobar',
        ],
    ]);

    expect($response)->message->text->toBe('foobar');
});
