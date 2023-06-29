<?php

declare(strict_types=1);

namespace Slack\Exceptions\Slack;

use Slack\Exceptions\ErrorException;

final class CannotAddOthersException extends ErrorException
{
    /**
     * Creates a new Exception instance.
     *
     * @param  array{ok: bool, error: string}  $response
     */
    public function __construct(array $response)
    {
        parent::__construct($response, "Guests can't set reminders for other team members.");
    }
}
