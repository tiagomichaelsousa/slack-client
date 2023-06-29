<?php

use Slack\Responses\Conversation\Channel;
use Slack\Responses\User\ListUserConversationsResponse;
use Slack\Testing\Responses\Fixtures\User\ListUserConversationsResponseFixture;

test('from json', function () {
    $response = ListUserConversationsResponse::from(ListUserConversationsResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(ListUserConversationsResponse::class)
        ->ok->toBe($response->ok)->toBeBool()
        ->channels->toBeArray()->toHaveCount(2)
        ->channels->each->toBeInstanceOf(Channel::class);
});

test('as array accessible', function () {
    $response = ListUserConversationsResponse::from(ListUserConversationsResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($response->ok);
    expect($response['channels'][0]['id'])->toBe($response->toArray()['channels'][0]['id']);
    expect($response['channels'][0]['name'])->toBe($response->toArray()['channels'][0]['name']);
});

test('to array', function () {
    $response = ListUserConversationsResponse::from($fixture = ListUserConversationsResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = ListUserConversationsResponse::fake();

    expect($response->channels[0])
        ->id->toBe(ListUserConversationsResponseFixture::ATTRIBUTES['channels'][0]['id']);
});

test('fake with override', function () {
    $response = ListUserConversationsResponse::fake([
        'channels' => [
            [
                'id' => 'foo',
            ],
        ],
    ]);

    expect($response['channels'][0])
        ->id->toBe('foo');
});
