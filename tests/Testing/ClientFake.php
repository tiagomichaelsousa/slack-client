<?php

use Slack\Testing\ClientFake;
use Slack\Resources\Conversation;
use PHPUnit\Framework\ExpectationFailedException;
use Slack\Responses\Conversation\ConversationInfoResponse;

it('returns a fake response', function () {
    $fake = new ClientFake([
        ConversationInfoResponse::fake([
            'channel' => [
                'id' => 'foo',
            ],
        ]),
    ]);

    $conversation = $fake->conversations()->info('channel');

    expect($conversation->channel->id)->toBe('foo');
});

it('throws fake exceptions', function () {
    $fake = new ClientFake([
        new \Slack\Exceptions\ErrorException([
            'ok' => 'false',
            'error' => 'some-error',
        ]),
    ]);

    $fake->conversations()->info('channel');
})->expectExceptionMessage('some-error');

it('throws an exception if there is no more fake response', function () {
    $fake = new ClientFake([
        ConversationInfoResponse::fake(),
    ]);

    $fake->conversations()->info('channel');

    $fake->conversations()->info('channel');
})->expectExceptionMessage('No fake responses left');

it('allows to add more responses', function () {
    $fake = new ClientFake([
        ConversationInfoResponse::fake([
            'ok' => false,
        ]),
    ]);

    $conversation = $fake->conversations()->info('channel');

    expect($conversation)->ok->toBeFalsy();

    $fake->addResponses([
        ConversationInfoResponse::fake([
            'ok' => true,
        ]),
    ]);

    $conversation = $fake->conversations()->info('channel');

    expect($conversation)->ok->toBeTruthy();
});

it('asserts a request was sent', function () {
    $fake = new ClientFake([
        ConversationInfoResponse::fake(),
    ]);

    $fake->conversations()->info('channel', ['include_num_members' => true]);

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'info' &&
          $parameters['channel'] === 'channel' &&
          $parameters['include_num_members'] === true;
    });
});

it('throws an exception if a request was not sent', function () {
    $fake = new ClientFake([
        ConversationInfoResponse::fake(),
    ]);

    $fake->assertSent(Conversation::class, function ($method, $parameters) {
        return $method === 'info' &&
          $parameters['channel'] === 'channel';
    });
})->expectException(ExpectationFailedException::class);

it('asserts a request was sent on the resource', function () {
    $fake = new ClientFake([
        ConversationInfoResponse::fake(),
    ]);

    $fake->conversations()->info('channel');

    $fake->conversations()->assertSent(fn ($method, $parameters) => $method === 'info');
});

it('asserts a request was sent n times', function () {
    $fake = new ClientFake([
        ConversationInfoResponse::fake(),
        ConversationInfoResponse::fake(),
    ]);

    $fake->conversations()->info('channel');

    $fake->conversations()->info('channel');

    $fake->assertSentTimes(Conversation::class, 2);
});

it('throws an exception if a request was not sent n times', function () {
    $fake = new ClientFake([
        ConversationInfoResponse::fake(),
        ConversationInfoResponse::fake(),
    ]);

    $fake->conversations()->info('channel');

    $fake->assertSentTimes(Conversation::class, 2);
})->expectException(ExpectationFailedException::class);

it('asserts a request was not sent', function () {
    $fake = new ClientFake();

    $fake->assertNotSent(Conversation::class);
});

it('throws an exception if an unexpected request was sent', function () {
    $fake = new ClientFake([
        ConversationInfoResponse::fake(),
    ]);

    $fake->conversations()->info('channel');

    $fake->assertNotSent(Conversation::class);
})->expectException(ExpectationFailedException::class);

it('asserts a request was not sent on the resource', function () {
    $fake = new ClientFake([
        ConversationInfoResponse::fake(),
    ]);

    $fake->conversations()->assertNotSent();
});

it('asserts no request was sent', function () {
    $fake = new ClientFake();

    $fake->assertNothingSent();
});

it('throws an exception if any request was sent when non was expected', function () {
    $fake = new ClientFake([
        ConversationInfoResponse::fake(),
    ]);

    $fake->conversations()->info('channel');

    $fake->assertNothingSent();
})->expectException(ExpectationFailedException::class);
