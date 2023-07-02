<?php

use Carbon\Carbon;
use Slack\Responses\Reaction\Message;
use Slack\Responses\Reaction\AddReactionResponse;
use Slack\Responses\Reaction\GetReactionResponse;
use Slack\Responses\Reaction\RemoveReactionResponse;

test('add', function () {
    $fake = AddReactionResponse::fake();
    $client = mockClient('POST', 'reactions.add', [], $fake->toArray());

    $result = $client->reactions()->add('channel', 'thumbsup', Carbon::now());

    expect($result)
        ->toBeInstanceOf(AddReactionResponse::class)
        ->ok->toBeTruthy();
});

test('get', function () {
    $fake = GetReactionResponse::fake();
    $client = mockClient('GET', 'reactions.get', [], $fake->toArray());

    $result = $client->reactions()->get('channel', Carbon::now());

    expect($result)
        ->toBeInstanceOf(GetReactionResponse::class)
        ->ok->toBeTruthy()
        ->type->toBe($fake->type)
        ->message->toBeInstanceOf(Message::class)
        ->message->type->toBe($fake->message->type)
        ->message->text->toBe($fake->message->text)
        ->message->ts->toBe($fake->message->ts)
        ->message->team->toBe($fake->message->team)
        ->message->permalink->toBe($fake->message->permalink)
        ->channel->toBe($fake->channel);
});

test('remove', function () {
    $fake = RemoveReactionResponse::fake();
    $client = mockClient('POST', 'reactions.remove', [], $fake->toArray());

    $result = $client->reactions()->remove('channel', 'thumbsup', Carbon::now());

    expect($result)
        ->toBeInstanceOf(RemoveReactionResponse::class)
        ->ok->toBeTruthy();
});
