<?php

use Slack\Client;
use Slack\ValueObjects\Token;
use Psr\Http\Message\ResponseInterface;
use Slack\Contracts\TransporterContract;
use Slack\ValueObjects\Transporter\BaseUri;
use Slack\ValueObjects\Transporter\Headers;
use Slack\ValueObjects\Transporter\Payload;
use Slack\ValueObjects\Transporter\QueryParams;

function mockClient(string $method, string $resource, array $params, array|string|ResponseInterface $response, $methodName = 'requestObject')
{
    $transporter = Mockery::mock(TransporterContract::class);

    $transporter
        ->shouldReceive($methodName)
        ->once()
        ->withArgs(function (Payload $payload) use ($method, $resource) {
            $baseUri = BaseUri::from('slack.com');
            $headers = Headers::withAuthorization(Token::from('foo'));
            $queryParams = QueryParams::create();

            $request = $payload->toRequest($baseUri, $headers, $queryParams);

            return $request->getMethod() === $method
                && $request->getUri()->getPath() === "/{$resource}";
        })->andReturn($response);

    return new Client($transporter);
}

function mockContentClient(string $method, string $resource, array $params, string $response)
{
    return mockClient($method, $resource, $params, $response, 'requestContent');
}

function mockStreamClient(string $method, string $resource, array $params, ResponseInterface $response)
{
    return mockClient($method, $resource, $params, $response, 'requestStream');
}
