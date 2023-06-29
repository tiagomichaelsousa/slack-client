<?php

declare(strict_types=1);

namespace Slack;

final class Slack
{
    /**
     * Creates a new Slack Client with the given token.
     */
    public static function client(string $token): Client
    {
        return self::factory()
            ->withToken($token)
            ->make();
    }

    /**
     * Creates a new factory instance to configure a custom Slack Client
     */
    public static function factory(): Factory
    {
        return new Factory();
    }
}
