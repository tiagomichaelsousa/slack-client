<?php

use Slack\Responses\User\Profile;
use Slack\Responses\User\GetProfileResponse;
use Slack\Testing\Responses\Fixtures\User\GetProfileResponseFixture;

test('from json', function () {
    $response = GetProfileResponse::from(GetProfileResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(GetProfileResponse::class)
        ->ok->toBe($response->ok)->toBeBool()
        ->profile->toBe($response->profile)->toBeInstanceOf(Profile::class);
});

test('as array accessible', function () {
    $response = GetProfileResponse::from(GetProfileResponseFixture::ATTRIBUTES);

    expect($response['profile']['title'])->toBe($response->profile->title);
    expect($response['profile']['real_name'])->toBe($response->profile->realName);
});

test('to array', function () {
    $response = GetProfileResponse::from($fixture = GetProfileResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = GetProfileResponse::fake();

    expect($response)
        ->profile->title->toBe(GetProfileResponseFixture::ATTRIBUTES['profile']['title']);
});

test('fake with override', function () {
    $response = GetProfileResponse::fake([
        'profile' => [
            'title' => 'foo',
        ],
    ]);

    expect($response)
        ->profile->title->toBe('foo');
});
