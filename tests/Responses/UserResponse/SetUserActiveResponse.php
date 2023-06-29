<?php

use Slack\Responses\User\SetUserActiveResponse;
use Slack\Testing\Responses\Fixtures\User\SetUserActiveResponseFixture;

test('from', function () {
    $response = SetUserActiveResponse::from($fixture = SetUserActiveResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(SetUserActiveResponse::class)
        ->ok->toBe($response->ok)->toBeBool();
});

test('as array accessible', function () {
    $response = SetUserActiveResponse::from($fixture = SetUserActiveResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($fixture['ok']);
});

test('to array', function () {
    $response = SetUserActiveResponse::from($fixture = SetUserActiveResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = SetUserActiveResponse::fake();

    expect($response->ok)
        ->toBe(SetUserActiveResponseFixture::ATTRIBUTES['ok']);
});

test('fake with override', function () {
    $response = SetUserActiveResponse::fake([
        'ok' => false,
    ]);

    expect($response)->ok->toBeFalsy();
});
