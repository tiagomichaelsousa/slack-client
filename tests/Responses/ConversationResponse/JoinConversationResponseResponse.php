<?php

use Slack\Responses\Conversation\ChannelTopic;
use Slack\Responses\Conversation\ChannelPurpose;
use Slack\Responses\Conversation\JoinConversationResponse;
use Slack\Testing\Responses\Fixtures\Conversation\JoinConversationResponseFixture;

test('from', function () {
    $response = JoinConversationResponse::from($fixture = JoinConversationResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(JoinConversationResponse::class)
        ->ok->toBe($response->ok)->toBeBool()
        ->channel->id->toBe($fixture['channel']['id'])
        ->channel->name->toBe($fixture['channel']['name'])
        ->channel->isChannel->toBe($fixture['channel']['is_channel'])
        ->channel->isGroup->toBe($fixture['channel']['is_group'])
        ->channel->isIm->toBe($fixture['channel']['is_im'])
        ->channel->created->toBe($fixture['channel']['created'])
        ->channel->creator->toBe($fixture['channel']['creator'])
        ->channel->isArchived->toBe($fixture['channel']['is_archived'])
        ->channel->unlinked->toBe($fixture['channel']['unlinked'])
        ->channel->nameNormalized->toBe($fixture['channel']['name_normalized'])
        ->channel->isShared->toBe($fixture['channel']['is_shared'])
        ->channel->isExtShared->toBe($fixture['channel']['is_ext_shared'])
        ->channel->isOrgShared->toBe($fixture['channel']['is_org_shared'])
        ->channel->isPendingExtShared->toBe($fixture['channel']['is_pending_ext_shared'])
        ->channel->isMember->toBe($fixture['channel']['is_member'])
        ->channel->isPrivate->toBe($fixture['channel']['is_private'])
        ->channel->isMpim->toBe($fixture['channel']['is_mpim'])
        ->channel->updated->toBe(null)
        ->channel->topic->toBeInstanceOf(ChannelTopic::class)
        ->channel->purpose->toBeInstanceOf(ChannelPurpose::class)
        ->channel->previousNames->toBeArray()->toHaveCount(0)
        ->channel->numMembers->toBe(null);
});

test('as array accessible', function () {
    $response = JoinConversationResponse::from($fixture = JoinConversationResponseFixture::ATTRIBUTES);

    expect($response['channel']['id'])->toBe($fixture['channel']['id']);
});

test('to array', function () {
    $response = JoinConversationResponse::from($fixture = JoinConversationResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = JoinConversationResponse::fake();

    expect($response->channel)
        ->id->toBe(JoinConversationResponseFixture::ATTRIBUTES['channel']['id']);
});

test('fake with override', function () {
    $response = JoinConversationResponse::fake([
        'channel' => [
            'id' => 'foo',
        ],
    ]);

    expect($response)->channel->id->toBe('foo');
});
