<?php

declare(strict_types=1);

namespace Slack\Exceptions;

use Exception;

class ErrorException extends Exception
{
    /**
     * Creates a new Exception instance.
     *
     * @param  array{ok: bool, error: string}  $contents
     * @param  string  $message
     */
    public function __construct(private readonly array $contents, $message = null)
    {
        parent::__construct($message ?: $contents['error']);
    }

    /**
     * Returns the error message.
     */
    public function getErrorMessage(): string
    {
        return $this->getMessage();
    }

    /**
     * Returns the error status.
     */
    public function getOk(): bool
    {
        return $this->contents['ok'];
    }

    /**
     * Returns the error status.
     */
    public function getError(): string
    {
        return $this->contents['error'];
    }
}
