<?php

use Slack\ValueObjects\Token;
use Slack\Enums\Transporter\ContentType;
use Slack\ValueObjects\Transporter\BaseUri;
use Slack\ValueObjects\Transporter\Headers;
use Slack\ValueObjects\Transporter\Payload;
use Slack\ValueObjects\Transporter\QueryParams;

it('has a method', function () {
    $payload = Payload::get('users.getProfile', []);

    $baseUri = BaseUri::from('slack.com');
    $headers = Headers::withAuthorization(Token::from('foo'))->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create();

    expect($payload->toRequest($baseUri, $headers, $queryParams)->getMethod())->toBe('GET');
});

it('has a uri', function () {
    $payload = Payload::get('users.getProfile', []);

    $baseUri = BaseUri::from('slack.com');
    $headers = Headers::withAuthorization(Token::from('foo'))->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create()->withParam('foo', 'bar');

    $uri = $payload->toRequest($baseUri, $headers, $queryParams)->getUri();

    expect($uri->getHost())->toBe('slack.com')
        ->and($uri->getScheme())->toBe('https')
        ->and($uri->getPath())->toBe('/users.getProfile')
        ->and($uri->getQuery())->toBe('foo=bar');
});

test('get verb does not have a body', function () {
    $payload = Payload::get('users.getProfile', []);

    $baseUri = BaseUri::from('slack.com');
    $headers = Headers::withAuthorization(Token::from('foo'))->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create();

    expect($payload->toRequest($baseUri, $headers, $queryParams)->getBody()->getContents())->toBe('');
});

test('post verb has a body', function () {
    $payload = Payload::post('users.getProfile', [
        'name' => 'test',
    ]);

    $baseUri = BaseUri::from('slack.com');
    $headers = Headers::withAuthorization(Token::from('foo'))->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create();

    expect($payload->toRequest($baseUri, $headers, $queryParams)->getBody()->getContents())->toBe(json_encode([
        'name' => 'test',
    ]));
});
