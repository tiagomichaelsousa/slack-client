<?php

use GuzzleHttp\Psr7\Response;
use Slack\ValueObjects\Token;
use Psr\Http\Client\ClientInterface;
use Slack\Exceptions\ErrorException;
use Psr\Http\Message\RequestInterface;
use Slack\Responses\User\UserResponse;
use Nyholm\Psr7\Request as Psr7Request;
use Psr\Http\Message\ResponseInterface;
use Slack\Transporters\HttpTransporter;
use Slack\Enums\Transporter\ContentType;
use GuzzleHttp\Exception\ConnectException;
use Slack\Exceptions\TransporterException;
use Slack\ValueObjects\Transporter\BaseUri;
use Slack\ValueObjects\Transporter\Headers;
use Slack\ValueObjects\Transporter\Payload;
use Slack\Exceptions\UnserializableResponse;
use Slack\ValueObjects\Transporter\QueryParams;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);

    $apiKey = Token::from('foo');

    $this->http = new HttpTransporter(
        $this->client,
        BaseUri::from('slack.com/api/v1'),
        Headers::withAuthorization($apiKey)->withContentType(ContentType::JSON),
        QueryParams::create()->withParam('foo', 'bar'),
        fn (RequestInterface $request): ResponseInterface => $this->client->sendAsyncRequest($request, ['stream' => true]),
    );
});

test('request object', function () {
    $payload = Payload::get('conversations', []);

    $response = new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], json_encode([
        'ok' => true,
    ]));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getMethod())->toBe('GET')
                ->and($request->getUri())
                ->getHost()->toBe('slack.com')
                ->getScheme()->toBe('https')
                ->getPath()->toBe('/api/v1/conversations');

            return true;
        })->andReturn($response);

    $this->http->requestObject($payload);
});

test('request object response', function () {
    $payload = Payload::get('users.getProfile', []);

    $response = new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], json_encode(
        $fixture = UserResponse::fake()->toArray()
    ));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $response = $this->http->requestObject($payload);

    expect($response)->toBe($fixture);
});

test('request object server errors', function () {
    $payload = Payload::get('users.getProfile', []);
    $fixture = [
        'ok' => false,
        'error' => 'service_unavailable',
    ];

    $response = new Response(401, ['Content-Type' => 'application/json; charset=utf-8'], json_encode($fixture));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->requestObject($payload))
        ->toThrow(function (ErrorException $e) {
            expect($e->getMessage())->toBe('The service is temporarily unavailable')
                ->and($e->getErrorMessage())->toBe('The service is temporarily unavailable')
                ->and($e->getOk())->toBeFalsy()
                ->and($e->getError())->toBe('service_unavailable');
        });
});

test('request object client errors', function () {
    $payload = Payload::get('users.getProfile', []);

    $baseUri = BaseUri::from('slack.com/api');
    $headers = Headers::withAuthorization(Token::from('foo'));
    $queryParams = QueryParams::create();

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andThrow(new ConnectException('Could not resolve host.', $payload->toRequest($baseUri, $headers, $queryParams)));

    expect(fn () => $this->http->requestObject($payload))->toThrow(function (TransporterException $e) {
        expect($e->getMessage())->toBe('Could not resolve host.')
            ->and($e->getCode())->toBe(0)
            ->and($e->getPrevious())->toBeInstanceOf(ConnectException::class);
    });
});

test('request object serialization errors', function () {
    $payload = Payload::get('users.getProfile', []);

    $response = new Response(200, ['Content-Type' => 'application/json; charset=utf-8'], 'err');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $this->http->requestObject($payload);
})->throws(UnserializableResponse::class, 'Syntax error');

test('request plain text', function () {
    $payload = Payload::get('users.getProfile', []);

    $response = new Response(200, ['Content-Type' => 'text/plain; charset=utf-8'], 'Hello, how are you?');

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $response = $this->http->requestObject($payload);

    expect($response)->toBe('Hello, how are you?');
});

test('request content', function () {
    $payload = Payload::get('users.getProfile', []);

    $response = new Response(200, [], json_encode(
        $fixture = UserResponse::fake()->toArray()
    ));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->withArgs(function (Psr7Request $request) {
            expect($request->getMethod())->toBe('GET')
                ->and($request->getUri())
                ->getHost()->toBe('slack.com')
                ->getScheme()->toBe('https')
                ->getPath()->toBe('/api/v1/users.getProfile');

            return true;
        })->andReturn($response);

    $this->http->requestContent($payload);
});

test('request content response', function () {
    $payload = Payload::get('users.getProfile', []);

    $response = new Response(200, [], json_encode(
        $fixture = UserResponse::fake()->toArray()
    ));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $response = $this->http->requestContent($payload);

    expect($response)->toBe(json_encode($fixture));
});

test('request content client errors', function () {
    $payload = Payload::get('users.getProfile', []);

    $baseUri = BaseUri::from('slack.com/api');
    $headers = Headers::withAuthorization(Token::from('foo'));
    $queryParams = QueryParams::create();

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andThrow(new ConnectException('Could not resolve host.', $payload->toRequest($baseUri, $headers, $queryParams)));

    expect(fn () => $this->http->requestContent($payload))->toThrow(function (TransporterException $e) {
        expect($e->getMessage())->toBe('Could not resolve host.')
            ->and($e->getCode())->toBe(0)
            ->and($e->getPrevious())->toBeInstanceOf(ConnectException::class);
    });
});

test('request content server errors', function () {
    $payload = Payload::get('users.getProfile', []);

    $fixture = [
        'ok' => false,
        'error' => 'service_unavailable',
    ];

    $response = new Response(401, ['Content-Type' => 'application/json; charset=utf-8'], json_encode($fixture));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->requestContent($payload))
        ->toThrow(function (ErrorException $e) {
            expect($e->getMessage())->toBe('The service is temporarily unavailable')
                ->and($e->getErrorMessage())->toBe('The service is temporarily unavailable')
                ->and($e->getOk())->toBeFalsy()
                ->and($e->getError())->toBe('service_unavailable');
        });
});
