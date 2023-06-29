<?php

test('contracts')->expect('Slack\Contracts')->toOnlyUse([
    'Slack\ValueObjects',
    'Slack\Exceptions',
    'Slack\Resources',
    'Psr\Http\Message\ResponseInterface',
    'Slack\Responses',
]);

test('exceptions')->expect('Slack\Exceptions')->toOnlyUse([
    'Psr\Http\Client',
]);

test('resources')->expect('Slack\Resources')->toOnlyUse([
    'Slack\Contracts',
    'Slack\ValueObjects',
    'Slack\Exceptions',
    'Slack\Responses',
    'Carbon\Carbon',
]);

test('responses')->expect('Slack\Responses')->toOnlyUse([
    'Slack\Enums',
    'Slack\Contracts',
    'Slack\Testing\Responses\Concerns',
    'Psr\Http\Message\ResponseInterface',
    'Psr\Http\Message\StreamInterface',
]);

test('value objects')->expect('Slack\ValueObjects')->toOnlyUse([
    'Http\Discovery\Psr17Factory',
    'Http\Message\MultipartStream\MultipartStreamBuilder',
    'Psr\Http\Message\RequestInterface',
    'Psr\Http\Message\StreamInterface',
    'Slack\Enums',
    'Slack\Contracts',
]);

test('client')->expect('Slack\Client')->toOnlyUse([
    'Slack\Resources',
    'Slack\Contracts',
]);

test('Slack')->expect('Slack')->toOnlyUse([
    'GuzzleHttp\Client',
    'GuzzleHttp\Exception\ClientException',
    'Http\Discovery\Psr17Factory',
    'Http\Discovery\Psr18ClientDiscovery',
    'Http\Message\MultipartStream\MultipartStreamBuilder',
    'Slack\Contracts',
    'Slack\Resources',
    'Psr\Http\Client',
    'Psr\Http\Message\RequestInterface',
    'Psr\Http\Message\ResponseInterface',
    'Psr\Http\Message\StreamInterface',
    'Symfony\Component\HttpClient\Psr18Client',
    'Carbon\Carbon',
])->ignoring('Slack\Testing');
