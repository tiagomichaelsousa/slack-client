<?php

declare(strict_types=1);

namespace Slack\Exceptions\Slack;

use Slack\Exceptions\ErrorException;

final class TokenRevokedException extends ErrorException
{
    /**
     * Creates a new Exception instance.
     *
     * @param  array{ok: bool, error: string}  $response
     */
    public function __construct(array $response)
    {
        parent::__construct($response, 'Authentication token is for a deleted user or workspace or the app has been removed when using a user token.');
    }
}
