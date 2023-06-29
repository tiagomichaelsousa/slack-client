<?php

use Slack\Responses\User\User;
use Slack\Responses\User\ListUsersResponse;
use Slack\Testing\Responses\Fixtures\User\ListUsersResponseFixture;

test('from json', function () {
    $response = ListUsersResponse::from(ListUsersResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(ListUsersResponse::class)
        ->ok->toBe($response->ok)->toBeBool()
        ->members->toBeArray()->toHaveCount(2)
        ->members->each->toBeInstanceOf(User::class);
});

test('as array accessible', function () {
    $response = ListUsersResponse::from(ListUsersResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($response->ok);
    expect($response['members'][0]['id'])->toBe($response->toArray()['members'][0]['id']);
    expect($response['members'][0]['name'])->toBe($response->toArray()['members'][0]['name']);
});

test('to array', function () {
    $response = ListUsersResponse::from($fixture = ListUsersResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = ListUsersResponse::fake();

    expect($response->members[0])
        ->id->toBe(ListUsersResponseFixture::ATTRIBUTES['members'][0]['id']);
});

test('fake with override', function () {
    $response = ListUsersResponse::fake([
        'members' => [
            [
                'id' => 'foo',
            ],
        ],
    ]);

    expect($response['members'][0])
        ->id->toBe('foo');
});
