<?php

use Slack\Responses\User\User;
use Slack\Responses\User\Profile;
use Slack\Responses\User\UserProfile;
use Slack\Responses\User\UserResponse;
use Slack\Responses\Conversation\Channel;
use Slack\Responses\User\ListUsersResponse;
use Slack\Responses\User\GetProfileResponse;
use Slack\Responses\User\SetUserActiveResponse;
use Slack\Responses\User\DeleteUserPhotoResponse;
use Slack\Responses\User\GetUserPresenceResponse;
use Slack\Responses\User\ListUserConversationsResponse;

test('info', function () {
    $fake = UserResponse::fake();
    $client = mockClient('GET', 'users.info', [], $fake->toArray());

    $result = $client->users()->info($fake->user->id, []);

    expect($result)
        ->toBeInstanceOf(UserResponse::class)
        ->ok->toBeTruthy()
        ->user->toBeInstanceOf(User::class);

    expect($result->user)
        ->id->toBe($fake->user->id)
        ->teamId->toBe($fake->user->teamId)
        ->name->toBe($fake->user->name)
        ->deleted->toBe($fake->user->deleted)
        ->color->toBe($fake->user->color)
        ->realName->toBe($fake->user->realName)
        ->tz->toBe($fake->user->tz)
        ->tzLabel->toBe($fake->user->tzLabel)
        ->tzOffset->toBe($fake->user->tzOffset)
        ->isAdmin->toBe($fake->user->isAdmin)
        ->isOwner->toBe($fake->user->isOwner)
        ->isPrimaryOwner->toBe($fake->user->isPrimaryOwner)
        ->isRestricted->toBe($fake->user->isRestricted)
        ->isUltraRestricted->toBe($fake->user->isUltraRestricted)
        ->isBot->toBe($fake->user->isBot)
        ->updated->toBe($fake->user->updated)
        ->isAppUser->toBe($fake->user->isAppUser);

    expect($result->user->profile)
        ->toBeInstanceOf(UserProfile::class)
        ->avatarHash->toBe($fake->user->profile->avatarHash)
        ->statusText->toBe($fake->user->profile->statusText)
        ->statusEmoji->toBe($fake->user->profile->statusEmoji)
        ->realName->toBe($fake->user->profile->realName)
        ->displayName->toBe($fake->user->profile->displayName)
        ->realNameNormalized->toBe($fake->user->profile->realNameNormalized)
        ->displayNameNormalized->toBe($fake->user->profile->displayNameNormalized)
        ->email->toBe($fake->user->profile->email)
        ->image24->toBe($fake->user->profile->image24)
        ->image32->toBe($fake->user->profile->image32)
        ->image48->toBe($fake->user->profile->image48)
        ->image72->toBe($fake->user->profile->image72)
        ->image192->toBe($fake->user->profile->image192)
        ->image512->toBe($fake->user->profile->image512)
        ->team->toBe($fake->user->profile->team);
});

test('list', function () {
    $fake = ListUsersResponse::fake();
    $client = mockClient('GET', 'users.list', [], $fake->toArray());

    $result = $client->users()->list();

    expect($result)
        ->toBeInstanceOf(ListUsersResponse::class)
        ->members->toBeArray()->toHaveCount(2)
        ->members->each->toBeInstanceOf(User::class);
});

test('conversations', function () {
    $fake = ListUserConversationsResponse::fake();
    $client = mockClient('GET', 'users.conversations', [], $fake->toArray());

    $result = $client->users()->conversations('user-id');

    expect($result)
        ->toBeInstanceOf(ListUserConversationsResponse::class)
        ->channels->toBeArray()->toHaveCount(2)
        ->channels->each->toBeInstanceOf(Channel::class);
});

test('deletePhoto', function () {
    $fake = DeleteUserPhotoResponse::fake();
    $client = mockClient('POST', 'users.deletePhoto', [], $fake->toArray());

    $result = $client->users()->deletePhoto();

    expect($result)
        ->toBeInstanceOf(DeleteUserPhotoResponse::class)
        ->ok->toBeTruthy();
});

test('getPresence', function () {
    $fake = GetUserPresenceResponse::fake();
    $client = mockClient('GET', 'users.getPresence', [], $fake->toArray());

    $result = $client->users()->getPresence('user');

    expect($result)
        ->toBeInstanceOf(GetUserPresenceResponse::class)
        ->ok->toBeTruthy()
        ->presence->toBe($fake->presence)
        ->online->toBe($fake->online)
        ->autoAway->toBe($fake->autoAway)
        ->manualAway->toBe($fake->manualAway)
        ->connectionCount->toBe($fake->connectionCount)
        ->lastActivity->toBe($fake->lastActivity);
});

test('setActive', function () {
    $fake = SetUserActiveResponse::fake();
    $client = mockClient('POST', 'users.setActive', [], $fake->toArray());

    $result = $client->users()->setActive();

    expect($result)
        ->toBeInstanceOf(SetUserActiveResponse::class)
        ->ok->toBeTruthy();
});

test('profile', function () {
    $fake = GetProfileResponse::fake();
    $client = mockClient('GET', 'users.profile.get', [], $fake->toArray());

    $result = $client->users()->getProfile('user-id');

    expect($result)
        ->toBeInstanceOf(GetProfileResponse::class)
        ->ok->toBeTruthy()
        ->profile->toBeInstanceOf(Profile::class);
});
