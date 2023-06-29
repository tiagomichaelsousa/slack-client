<?php

declare(strict_types=1);

namespace Slack\Exceptions\Slack;

use Slack\Exceptions\ErrorException;

final class CannotCompleteOthersException extends ErrorException
{
    /**
     * Creates a new Exception instance.
     *
     * @param  array{ok: bool, error: string}  $response
     */
    public function __construct(array $response)
    {
        parent::__construct($response, "Reminders for other team members can't be marked complete.");
    }
}
