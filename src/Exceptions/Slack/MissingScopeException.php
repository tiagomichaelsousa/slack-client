<?php

declare(strict_types=1);

namespace Slack\Exceptions\Slack;

use Slack\Exceptions\ErrorException;

final class MissingScopeException extends ErrorException
{
    /**
     * Creates a new Exception instance.
     *
     * @param  array{ok: bool, error: string, provided: string, needed: string}  $response
     */
    public function __construct(array $response)
    {
        $message = 'The token used is not granted the specific scope permissions required to complete this request.'.PHP_EOL.PHP_EOL;
        $message .= 'Provided: '.$response['provided'].PHP_EOL;
        $message .= 'Needed: '.$response['needed'].PHP_EOL;

        parent::__construct($response, $message);
    }
}
