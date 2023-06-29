<?php

use Slack\Responses\User\DeleteUserPhotoResponse;
use Slack\Testing\Responses\Fixtures\User\DeleteUserPhotoResponseFixture;

test('from', function () {
    $response = DeleteUserPhotoResponse::from($fixture = DeleteUserPhotoResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(DeleteUserPhotoResponse::class)
        ->ok->toBe($response->ok)->toBeBool();
});

test('as array accessible', function () {
    $response = DeleteUserPhotoResponse::from($fixture = DeleteUserPhotoResponseFixture::ATTRIBUTES);

    expect($response['ok'])->toBe($fixture['ok']);
});

test('to array', function () {
    $response = DeleteUserPhotoResponse::from($fixture = DeleteUserPhotoResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = DeleteUserPhotoResponse::fake();

    expect($response->ok)
        ->toBe(DeleteUserPhotoResponseFixture::ATTRIBUTES['ok']);
});

test('fake with override', function () {
    $response = DeleteUserPhotoResponse::fake([
        'ok' => false,
    ]);

    expect($response)->ok->toBeFalsy();
});
