<?php

declare(strict_types=1);

namespace Slack\ValueObjects;

use Slack\Contracts\StringableContract;

/**
 * @internal
 */
final class ResourceUri implements StringableContract
{
    /**
     * Creates a new ResourceUri value object.
     */
    private function __construct(private readonly string $uri)
    {
        // ..
    }

    /**
     * Creates a new ResourceUri value object that lists the given resource.
     */
    public static function get(string $resource): self
    {
        return new self($resource);
    }

    /**
     * Creates a new ResourceUri value object that creates the given resource.
     */
    public static function post(string $resource): self
    {
        return new self($resource);
    }

    /**
     * {@inheritDoc}
     */
    public function toString(): string
    {
        return $this->uri;
    }
}
