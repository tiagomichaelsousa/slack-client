<?php

use Carbon\Carbon;
use Slack\Resources\Reaction;
use Slack\Testing\ClientFake;
use Slack\Responses\Reaction\AddReactionResponse;
use Slack\Responses\Reaction\GetReactionResponse;
use Slack\Responses\Reaction\RemoveReactionResponse;

it('allows to react to a message', function () {
    $fake = new ClientFake([
        AddReactionResponse::fake(),
    ]);

    $fake->reactions()->add('channel', 'heart', $date = Carbon::now());

    $fake->assertSent(Reaction::class, function ($method, $parameters) use ($date) {
        return $method === 'add' &&
          $parameters['channel'] === 'channel' &&
          $parameters['name'] === 'heart' &&
          $parameters['timestamp'] === (string) Carbon::instance($date)->timestamp;
    });
});

it('allows to get a reaction from a message', function () {
    $fake = new ClientFake([
        GetReactionResponse::fake(),
    ]);

    $fake->reactions()->get('channel', $date = Carbon::now());

    $fake->assertSent(Reaction::class, function ($method, $parameters) use ($date) {
        return $method === 'get' &&
          $parameters['channel'] === 'channel' &&
          $parameters['timestamp'] === (string) Carbon::instance($date)->timestamp;
    });
});

it('allows to remove a reaction from a message', function () {
    $fake = new ClientFake([
        RemoveReactionResponse::fake(),
    ]);

    $fake->reactions()->remove('channel', 'heart', $date = Carbon::now());

    $fake->assertSent(Reaction::class, function ($method, $parameters) use ($date) {
        return $method === 'remove' &&
          $parameters['channel'] === 'channel' &&
          $parameters['name'] === 'heart' &&
          $parameters['timestamp'] === (string) Carbon::instance($date)->timestamp;
    });
});

it('allows to list the reactions', function () {
})->todo();
