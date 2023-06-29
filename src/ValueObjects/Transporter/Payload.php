<?php

declare(strict_types=1);

namespace Slack\ValueObjects\Transporter;

use Http\Discovery\Psr17Factory;
use Slack\Enums\Transporter\Method;
use Slack\ValueObjects\ResourceUri;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\RequestInterface;
use Slack\Enums\Transporter\ContentType;
use Http\Message\MultipartStream\MultipartStreamBuilder;

/**
 * @internal
 */
final class Payload
{
    /**
     * Creates a new Request value object.
     *
     * @param  array<string, mixed>  $parameters
     */
    private function __construct(
        private readonly ContentType $contentType,
        private readonly Method $method,
        private readonly ResourceUri $uri,
        private readonly array $parameters = [],
    ) {
        // ..
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param  array<string, mixed>  $parameters
     */
    public static function get(string $resource, array $parameters): self
    {
        $uri = ResourceUri::get($resource);

        return new self(ContentType::JSON, Method::GET, $uri, $parameters);
    }

    /**
     * Creates a new Payload value object from the given parameters.
     *
     * @param  array<string, mixed>  $parameters
     */
    public static function post(string $resource, array $parameters): self
    {
        $uri = ResourceUri::post($resource);

        return new self(ContentType::JSON, Method::POST, $uri, $parameters);
    }

    /**
     * Creates a new Psr 7 Request instance.
     */
    public function toRequest(BaseUri $baseUri, Headers $headers, QueryParams $queryParams): RequestInterface
    {
        $psr17Factory = new Psr17Factory();

        $body = null;

        $uri = $baseUri->toString().$this->uri->toString();

        if ($queryParams->toArray() !== [] || $this->parameters !== []) {
            $uri .= '?'.http_build_query([...$queryParams->toArray(), ...$this->parameters]);
        }

        $headers = $headers->withContentType($this->contentType);

        if ($this->method === Method::POST) {
            if ($this->contentType === ContentType::MULTIPART) {
                $streamBuilder = new MultipartStreamBuilder($psr17Factory);

                /** @var array<string, StreamInterface|string|int|float|bool|array<string, mixed>> $parameters */
                $parameters = $this->parameters;

                foreach ($parameters as $key => $value) {
                    if (is_int($value) || is_float($value) || is_bool($value)) {
                        $value = (string) $value;
                    }

                    if (is_array($value)) {
                        $value = json_encode($value, JSON_THROW_ON_ERROR);
                    }

                    $streamBuilder->addResource($key, $value);
                }

                /** @phpstan-ignore-next-line **/
                if (! $body) {
                    $streamBuilder->addResource('content', 'null');
                }

                $body = $streamBuilder->build();

                $headers = $headers->withContentType($this->contentType, '; boundary='.$streamBuilder->getBoundary());
            } else {
                $body = $psr17Factory->createStream(json_encode($this->parameters, JSON_THROW_ON_ERROR));
            }
        }

        $request = $psr17Factory->createRequest($this->method->value, $uri);

        if ($body instanceof \Psr\Http\Message\StreamInterface) {
            $request = $request->withBody($body);
        }

        foreach ($headers->toArray() as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        return $request;
    }
}
