<?php

use Slack\Responses\Conversation\Channel;
use Slack\Responses\Conversation\ListConversationsResponse;
use Slack\Testing\Responses\Fixtures\Conversation\ListConversationsResponseFixture;

test('from json', function () {
    $response = ListConversationsResponse::from(ListConversationsResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(ListConversationsResponse::class)
        ->ok->toBe($response->ok)->toBeBool()
        ->channels->toBeArray()->toHaveCount(2)
        ->channels->each->toBeInstanceOf(Channel::class);
});

test('as array accessible', function () {
    $response = ListConversationsResponse::from(ListConversationsResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($response->ok);
    expect($response['channels'][0]['id'])->toBe($response->toArray()['channels'][0]['id']);
    expect($response['channels'][0]['name'])->toBe($response->toArray()['channels'][0]['name']);
});

test('to array', function () {
    $response = ListConversationsResponse::from($fixture = ListConversationsResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = ListConversationsResponse::fake();

    expect($response->channels[0])
        ->id->toBe(ListConversationsResponseFixture::ATTRIBUTES['channels'][0]['id']);
});

test('fake with override', function () {
    $response = ListConversationsResponse::fake([
        'channels' => [
            [
                'id' => 'foo',
            ],
        ],
    ]);

    expect($response['channels'][0])
        ->id->toBe('foo');
});
