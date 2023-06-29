<?php

use Slack\Responses\Conversation\Channel;
use Slack\Responses\Conversation\ConversationInfoResponse;
use Slack\Responses\Conversation\JoinConversationResponse;
use Slack\Responses\Conversation\CloseConversationResponse;
use Slack\Responses\Conversation\ListConversationsResponse;
use Slack\Responses\Conversation\CreateConversationResponse;
use Slack\Responses\Conversation\InviteConversationResponse;
use Slack\Responses\Conversation\RenameConversationResponse;
use Slack\Responses\Conversation\ArchiveConversationResponse;
use Slack\Responses\Conversation\ConversationMembersResponse;
use Slack\Responses\Conversation\SetConversationTopicResponse;
use Slack\Responses\Conversation\UnarchiveConversationResponse;
use Slack\Responses\Conversation\KickUserFromConversationResponse;

test('list', function () {
    $fake = ListConversationsResponse::fake();
    $client = mockClient('GET', 'conversations.list', [], $fake->toArray());

    $result = $client->conversations()->list();

    expect($result)
        ->toBeInstanceOf(ListConversationsResponse::class)
        ->ok->toBeTruthy()
        ->channels->toBeArray()->toHaveCount(2)
        ->channels->each->toBeInstanceOf(Channel::class);
});

test('info', function () {
    $fake = ConversationInfoResponse::fake();
    $client = mockClient('GET', 'conversations.info', [], $fake->toArray());

    $result = $client->conversations()->info('channel');

    expect($result)
        ->toBeInstanceOf(ConversationInfoResponse::class)
        ->ok->toBeTruthy()
        ->channel->toBeInstanceOf(Channel::class);
});

test('kick', function () {
    $fake = KickUserFromConversationResponse::fake();
    $client = mockClient('POST', 'conversations.kick', [], $fake->toArray());

    $result = $client->conversations()->kick('channel', 'user');

    expect($result)
        ->toBeInstanceOf(KickUserFromConversationResponse::class)
        ->ok->toBeTruthy();
});

test('members', function () {
    $fake = ConversationMembersResponse::fake();
    $client = mockClient('GET', 'conversations.members', [], $fake->toArray());

    $result = $client->conversations()->members('channel');

    expect($result)
        ->toBeInstanceOf(ConversationMembersResponse::class)
        ->ok->toBeTruthy()
        ->members->toBeArray()->toHaveCount(1);
});

test('invite', function () {
    $fake = InviteConversationResponse::fake();
    $client = mockClient('POST', 'conversations.invite', [], $fake->toArray());

    $result = $client->conversations()->invite('channel', 'user');

    expect($result)
        ->toBeInstanceOf(InviteConversationResponse::class)
        ->ok->toBeTruthy()
        ->channel->toBeInstanceOf(Channel::class);
});

test('invite with multiple users', function () {
    $fake = InviteConversationResponse::fake();
    $client = mockClient('POST', 'conversations.invite', [], $fake->toArray());

    $result = $client->conversations()->invite('channel', ['user', 'user-2']);

    expect($result)
        ->toBeInstanceOf(InviteConversationResponse::class)
        ->ok->toBeTruthy()
        ->channel->toBeInstanceOf(Channel::class);
});

test('create', function () {
    $fake = CreateConversationResponse::fake();
    $client = mockClient('POST', 'conversations.create', [], $fake->toArray());

    $result = $client->conversations()->create('name');

    expect($result)
        ->toBeInstanceOf(CreateConversationResponse::class)
        ->ok->toBeTruthy()
        ->channel->toBeInstanceOf(Channel::class);
});

test('join', function () {
    $fake = JoinConversationResponse::fake();
    $client = mockClient('POST', 'conversations.join', [], $fake->toArray());

    $result = $client->conversations()->join('channel');

    expect($result)
        ->toBeInstanceOf(JoinConversationResponse::class)
        ->ok->toBeTruthy()
        ->channel->toBeInstanceOf(Channel::class);
});

test('archive', function () {
    $fake = ArchiveConversationResponse::fake();
    $client = mockClient('POST', 'conversations.archive', [], $fake->toArray());

    $result = $client->conversations()->archive('channel');

    expect($result)
        ->toBeInstanceOf(ArchiveConversationResponse::class)
        ->ok->toBeTruthy();
});

test('unarchive', function () {
    $fake = UnarchiveConversationResponse::fake();
    $client = mockClient('POST', 'conversations.unarchive', [], $fake->toArray());

    $result = $client->conversations()->unarchive('channel');

    expect($result)
        ->toBeInstanceOf(UnarchiveConversationResponse::class)
        ->ok->toBeTruthy();
});

test('close', function () {
    $fake = CloseConversationResponse::fake();
    $client = mockClient('POST', 'conversations.close', [], $fake->toArray());

    $result = $client->conversations()->close('channel');

    expect($result)
        ->toBeInstanceOf(CloseConversationResponse::class)
        ->ok->toBeTruthy();
});

test('rename', function () {
    $fake = RenameConversationResponse::fake();
    $client = mockClient('POST', 'conversations.rename', [], $fake->toArray());

    $result = $client->conversations()->rename('channel', 'new-name');

    expect($result)
        ->toBeInstanceOf(RenameConversationResponse::class)
        ->ok->toBeTruthy()
        ->channel->toBeInstanceOf(Channel::class);
});

test('setTopic', function () {
    $fake = SetConversationTopicResponse::fake();
    $client = mockClient('POST', 'conversations.setTopic', [], $fake->toArray());

    $result = $client->conversations()->setTopic('channel', 'new-topic');

    expect($result)
        ->toBeInstanceOf(SetConversationTopicResponse::class)
        ->ok->toBeTruthy()
        ->channel->toBeInstanceOf(Channel::class);
});
