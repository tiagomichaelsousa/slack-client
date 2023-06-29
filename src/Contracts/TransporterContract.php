<?php

declare(strict_types=1);

namespace Slack\Contracts;

use Slack\Exceptions\ErrorException;
use Slack\Exceptions\TransporterException;
use Slack\ValueObjects\Transporter\Payload;
use Slack\Exceptions\UnserializableResponse;

/**
 * @internal
 */
interface TransporterContract
{
    /**
     * Sends a request to a server.
     **
     * @return array<array-key, mixed>
     *
     * @throws ErrorException|UnserializableResponse|TransporterException
     */
    public function requestObject(Payload $payload): array|string;

    /**
     * Sends a content request to a server.
     *
     * @throws ErrorException|TransporterException
     */
    public function requestContent(Payload $payload): string;
}
