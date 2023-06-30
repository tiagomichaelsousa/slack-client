<?php

use Slack\Client;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

it('may create a client', function () {
    $slack = Slack::client('foo');

    expect($slack)->toBeInstanceOf(Client::class);
});

it('may create a client via factory', function () {
    $slack = Slack::factory()
        ->withToken('foo')
        ->make();

    expect($slack)->toBeInstanceOf(Client::class);
});

it('sets a custom client via factory', function () {
    $slack = Slack::factory()
        ->withHttpClient(new GuzzleClient())
        ->make();

    expect($slack)->toBeInstanceOf(Client::class);
});

it('sets a custom base url via factory', function () {
    $slack = Slack::factory()
        ->withBaseUri('https://slack.com/v1')
        ->make();

    expect($slack)->toBeInstanceOf(Client::class);
});

it('sets a custom header via factory', function () {
    $slack = Slack::factory()
        ->withHttpHeader('X-My-Header', 'foo')
        ->make();

    expect($slack)->toBeInstanceOf(Client::class);
});

it('sets a custom query parameter via factory', function () {
    $slack = Slack::factory()
        ->withQueryParam('my-param', 'bar')
        ->make();

    expect($slack)->toBeInstanceOf(Client::class);
});

it('sets a custom stream handler via factory', function () {
    $slack = Slack::factory()
        ->withHttpClient($client = new GuzzleClient())
        ->withStreamHandler(fn (RequestInterface $request): ResponseInterface => $client->send($request, ['stream' => true]))
        ->make();

    expect($slack)->toBeInstanceOf(Client::class);
});
