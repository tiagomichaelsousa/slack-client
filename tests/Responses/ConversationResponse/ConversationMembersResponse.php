<?php

use Slack\Responses\Conversation\ConversationMembersResponse;
use Slack\Testing\Responses\Fixtures\Conversation\ConversationMembersResponseFixture;

test('from', function () {
    $response = ConversationMembersResponse::from($fixture = ConversationMembersResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(ConversationMembersResponse::class)
        ->ok->toBe($response->ok)->toBeBool()
        ->members->toBeArray()->toHaveCount(1);
});

test('as array accessible', function () {
    $response = ConversationMembersResponse::from($fixture = ConversationMembersResponseFixture::ATTRIBUTES);

    expect($response['members'])->toBe($fixture['members']);
});

test('to array', function () {
    $response = ConversationMembersResponse::from($fixture = ConversationMembersResponseFixture::ATTRIBUTES);

    expect($response->toArray())->toBe($fixture);
});

test('fake', function () {
    $response = ConversationMembersResponse::fake();

    expect($response->members[0])
        ->toBeString()
        ->toBe(ConversationMembersResponseFixture::ATTRIBUTES['members'][0]);
});

test('fake with override', function () {
    $response = ConversationMembersResponse::fake([
        'members' => [
            'foo',
        ],
    ]);

    expect($response->members[0])->toBe('foo');
});
