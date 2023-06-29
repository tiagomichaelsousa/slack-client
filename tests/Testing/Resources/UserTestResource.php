<?php

use Slack\Resources\User;
use Slack\Testing\ClientFake;
use Slack\Responses\User\UserResponse;
use Slack\Responses\User\ListUsersResponse;
use Slack\Responses\User\GetProfileResponse;
use Slack\Responses\User\SetUserActiveResponse;
use Slack\Responses\User\DeleteUserPhotoResponse;
use Slack\Responses\User\GetUserPresenceResponse;
use Slack\Responses\User\ListUserConversationsResponse;

it('allows to retrieve the user conversations', function () {
    $fake = new ClientFake([
        ListUserConversationsResponse::fake(),
    ]);

    $fake->users()->conversations('user');

    $fake->assertSent(User::class, function ($method, $parameters) {
        return $method === 'conversations' &&
            $parameters['user'] === 'user';
    });
});

it('allows to delete a photo for the user', function () {
    $fake = new ClientFake([
        DeleteUserPhotoResponse::fake(),
    ]);

    $fake->users()->deletePhoto();

    $fake->assertSent(User::class, fn ($method, $parameters) => $method === 'deletePhoto');
});

it('allows to retrieve the user presence', function () {
    $fake = new ClientFake([
        GetUserPresenceResponse::fake(),
    ]);

    $fake->users()->getPresence('user');

    $fake->assertSent(User::class, function ($method, $parameters) {
        return $method === 'getPresence' &&
            $parameters['user'] === 'user';
    });
});

it('allows to set a user active', function () {
    $fake = new ClientFake([
        SetUserActiveResponse::fake(),
    ]);

    $fake->users()->setActive();

    $fake->assertSent(User::class, fn ($method) => $method === 'setActive');
});

it('allows to retrieve the info about a user', function () {
    $fake = new ClientFake([
        UserResponse::fake(),
    ]);

    $fake->users()->info('user', [
        'include_locale' => true,
    ]);

    $fake->assertSent(User::class, function ($method, $parameters) {
        return $method === 'info' &&
            $parameters['user'] === 'user' &&
            $parameters['include_locale'] === true;
    });
});

it('allows to retrieve the users', function () {
    $fake = new ClientFake([
        ListUsersResponse::fake(),
    ]);

    $fake->users()->list([
        'limit' => 200,
        'team_id' => 'T1234567890',
        'cursor' => 'dXNlcjpVMDYxTkZUVDI=',
        'include_locale' => true,
    ]);

    $fake->assertSent(User::class, function ($method, $parameters) {
        return $method === 'list' &&
            $parameters['limit'] === 200 &&
            $parameters['team_id'] === 'T1234567890' &&
            $parameters['cursor'] === 'dXNlcjpVMDYxTkZUVDI=' &&
            $parameters['include_locale'] === true;
    });
});

it('allows to get the profile for a user', function () {
    $fake = new ClientFake([
        GetProfileResponse::fake(),
    ]);

    $fake->users()->getProfile('user', [
        'include_labels' => true,
    ]);

    $fake->assertSent(User::class, function ($method, $parameters) {
        return $method === 'getProfile' &&
            $parameters['user'] === 'user' &&
            $parameters['include_labels'] === true;
    });
});
