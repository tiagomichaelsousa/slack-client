<?php

declare(strict_types=1);

namespace Slack\ValueObjects;

use Slack\Contracts\StringableContract;

/**
 * @internal
 */
final class Token implements StringableContract
{
    /**
     * Creates a new token value object.
     */
    private function __construct(public readonly string $token)
    {
        // ..
    }

    public static function from(string $token): self
    {
        return new self($token);
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return $this->token;
    }
}
