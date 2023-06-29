<?php

use Slack\Responses\User\GetUserPresenceResponse;
use Slack\Testing\Responses\Fixtures\User\GetUserPresenceResponseFixture;

test('from json', function () {
    $response = GetUserPresenceResponse::from($fixture = GetUserPresenceResponseFixture::ATTRIBUTES);

    expect($response)
        ->toBeInstanceOf(GetUserPresenceResponse::class)
        ->ok->toBe($response->ok)->toBeBool()
        ->presence->toBe($fixture['presence'])
        ->online->toBe($fixture['online'])
        ->autoAway->toBe($fixture['auto_away'])
        ->manualAway->toBe($fixture['manual_away'])
        ->connectionCount->toBe($fixture['connection_count'])
        ->lastActivity->toBe($fixture['last_activity']);
});

test('as array accessible', function () {
    $response = GetUserPresenceResponse::from($fixture = GetUserPresenceResponseFixture::ATTRIBUTES);

    expect($response['presence'])->toBe($fixture['presence']);
    expect($response['online'])->toBe($fixture['online']);
    expect($response['auto_away'])->toBe($fixture['auto_away']);
    expect($response['manual_away'])->toBe($fixture['manual_away']);
    expect($response['connection_count'])->toBe($fixture['connection_count']);
    expect($response['last_activity'])->toBe($fixture['last_activity']);
});

test('to array', function () {
    $response = GetUserPresenceResponse::from($fixture = GetUserPresenceResponseFixture::ATTRIBUTES);

    expect($response->toArray())
        ->toBeArray()
        ->toBe($fixture);
});

test('fake', function () {
    $response = GetUserPresenceResponse::fake();

    expect($response)
        ->presence->toBe(GetUserPresenceResponseFixture::ATTRIBUTES['presence']);
});

test('fake with override', function () {
    $response = GetUserPresenceResponse::fake([
        'presence' => 'offline',
    ]);

    expect($response)
        ->presence->toBe('offline');
});
