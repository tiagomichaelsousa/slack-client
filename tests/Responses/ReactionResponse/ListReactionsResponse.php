<?php

use Slack\Responses\Reaction\MessageItems;
use Slack\Responses\Common\ResponseMetadata;
use Slack\Responses\Reaction\ListReactionsResponse;
use Slack\Testing\Responses\Fixtures\Reaction\ListReactionsResponseFixture;

test('from json', function () {
    $response = ListReactionsResponse::from(ListReactionsResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(ListReactionsResponse::class)
        ->ok->toBe($response->ok)->toBeBool()
        ->items->toBeArray()->toHaveCount(1)
        ->items->each->toBeInstanceOf(MessageItems::class)
        ->responseMetadata->toBeInstanceOf(ResponseMetadata::class);
});

test('as array accessible', function () {
    $response = ListReactionsResponse::from(ListReactionsResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($response->ok);
    expect($response['items'][0]['type'])->toBe($response->toArray()['items'][0]['type']);
    expect($response['items'][0]['channel'])->toBe($response->toArray()['items'][0]['channel']);
    expect($response['items'][0]['message']['type'])->toBe($response->toArray()['items'][0]['message']['type']);
    expect($response['response_metadata'])->toBe($response->responseMetadata->toArray());
});

test('to array', function () {
    $response = ListReactionsResponse::from($fixture = ListReactionsResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = ListReactionsResponse::fake();

    expect($response->items[0])
        ->type->toBe(ListReactionsResponseFixture::ATTRIBUTES['items'][0]['type']);
});

test('fake with override', function () {
    $response = ListReactionsResponse::fake([
        'items' => [
            [
                'type' => 'foo',
            ],
        ],
    ]);

    expect($response['items'][0])
        ->type->toBe('foo');
});
