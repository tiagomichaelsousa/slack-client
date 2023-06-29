<?php

use Slack\Testing\ClientFake;
use Slack\Resources\Conversation;
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
use Slack\Responses\Conversation\SetConversationPurposeResponse;
use Slack\Responses\Conversation\KickUserFromConversationResponse;

it('allows to retrieve all the conversations', function () {
    $fake = new ClientFake([
        ListConversationsResponse::fake(),
    ]);

    $fake->conversations()->list([
        'limit' => 200,
        'exclude_archived' => true,
        'team_id' => 'T1234567890',
        'types' => 'public_channel,private_channel',
    ]);

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'list' &&
          $parameters['limit'] === 200 &&
          $parameters['exclude_archived'] === true &&
          $parameters['team_id'] === 'T1234567890' &&
          $parameters['types'] === 'public_channel,private_channel';
    });
});

it('allows to retrieve the info from a conversation', function () {
    $fake = new ClientFake([
        ConversationInfoResponse::fake(),
    ]);

    $fake->conversations()->info('channel', [
        'include_locale' => true,
        'include_num_members' => true,
    ]);

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'info' &&
          $parameters['include_locale'] === true &&
          $parameters['include_num_members'] === true;
    });
});

it('allows to kick a user from a conversation', function () {
    $fake = new ClientFake([
        KickUserFromConversationResponse::fake(),
    ]);

    $fake->conversations()->kick('channel', 'U012DCGK1SU');

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'kick' &&
          $parameters['channel'] === 'channel' &&
          $parameters['user'] === 'U012DCGK1SU';
    });
});

it('allows to retrieve the members from a conversation', function () {
    $fake = new ClientFake([
        ConversationMembersResponse::fake(),
    ]);

    $fake->conversations()->members('channel', [
        'cursor' => 'dGVhbTpDMDYxRkE1UEI=',
        'limit' => 200,
    ]);

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'members' &&
          $parameters['channel'] === 'channel' &&
          $parameters['cursor'] === 'dGVhbTpDMDYxRkE1UEI=' &&
          $parameters['limit'] === 200;
    });
});

it('allows to invite the users to a conversation', function () {
    $fake = new ClientFake([
        InviteConversationResponse::fake(),
    ]);

    $fake->conversations()->invite('channel', ['U012DCGK1SU', 'U061F7AUR']);

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'invite' &&
          $parameters['channel'] === 'channel' &&
          $parameters['users'] === 'U012DCGK1SU,U061F7AUR';
    });
});

it('allows to create a new conversation', function () {
    $fake = new ClientFake([
        CreateConversationResponse::fake(),
    ]);

    $fake->conversations()->create('channel', [
        'is_private' => true,
    ]);

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'create' &&
          $parameters['name'] === 'channel' &&
          $parameters['is_private'] === true;
    });
});

it('allows join an existent conversation', function () {
    $fake = new ClientFake([
        JoinConversationResponse::fake(),
    ]);

    $fake->conversations()->join('channel');

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'join' &&
          $parameters['channel'] === 'channel';
    });
});

it('allows archive an existent conversation', function () {
    $fake = new ClientFake([
        ArchiveConversationResponse::fake(),
    ]);

    $fake->conversations()->archive('channel');

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'archive' &&
          $parameters['channel'] === 'channel';
    });
});

it('allows unarchive an existent conversation', function () {
    $fake = new ClientFake([
        UnarchiveConversationResponse::fake(),
    ]);

    $fake->conversations()->unarchive('channel');

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'unarchive' &&
          $parameters['channel'] === 'channel';
    });
});

it('allows close a conversation', function () {
    $fake = new ClientFake([
        CloseConversationResponse::fake(),
    ]);

    $fake->conversations()->close('channel');

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'close' &&
          $parameters['channel'] === 'channel';
    });
});

it('allows to rename a conversation', function () {
    $fake = new ClientFake([
        RenameConversationResponse::fake(),
    ]);

    $fake->conversations()->rename('channel', 'new-channel');

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'rename' &&
          $parameters['channel'] === 'channel' &&
          $parameters['name'] === 'new-channel';
    });
});

it('allows to set the topic for a conversation', function () {
    $fake = new ClientFake([
        SetConversationTopicResponse::fake(),
    ]);

    $fake->conversations()->setTopic('channel', 'topic');

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'setTopic' &&
          $parameters['channel'] === 'channel' &&
          $parameters['topic'] === 'topic';
    });
});

it('allows to set the purpose for a conversation', function () {
    $fake = new ClientFake([
        SetConversationPurposeResponse::fake(),
    ]);

    $fake->conversations()->setPurpose('channel', 'purpose');

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'setPurpose' &&
          $parameters['channel'] === 'channel' &&
          $parameters['purpose'] === 'purpose';
    });
});
