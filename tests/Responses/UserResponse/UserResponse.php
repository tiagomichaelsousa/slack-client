<?php

use Slack\Responses\User\User;
use Slack\Responses\User\UserProfile;
use Slack\Responses\User\UserResponse;
use Slack\Testing\Responses\Fixtures\User\UserResponseFixture;

test('from json', function () {
    $response = UserResponse::from(UserResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(UserResponse::class)
        ->ok->toBe($response->ok)->toBeBool()
        ->user->toBe($response->user)->toBeInstanceOf(User::class)
        ->user->profile->toBe($response->user->profile)->toBeInstanceOf(UserProfile::class);
});

test('as array accessible', function () {
    $response = UserResponse::from(UserResponseFixture::ATTRIBUTES);

    expect($response['user']['id'])->toBe($response->user->id);
    expect($response['user']['profile']['avatar_hash'])->toBe($response->user->profile->avatarHash);
});

test('to array', function () {
    $response = UserResponse::from(UserResponseFixture::ATTRIBUTES);

    expect($response->toArray())
        ->toBeArray()
        ->toBe(UserResponseFixture::ATTRIBUTES);
});

test('fake', function () {
    $response = UserResponse::fake();

    expect($response)
        ->user->id->toBe(UserResponseFixture::ATTRIBUTES['user']['id']);
});

test('fake with override', function () {
    $response = UserResponse::fake([
        'user' => [
            'id' => 'foo',
        ],
    ]);

    expect($response)
        ->user->id->toBe('foo');
});
