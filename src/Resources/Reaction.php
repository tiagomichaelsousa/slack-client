<?php

declare(strict_types=1);

namespace Slack\Resources;

use DateTime;
use Carbon\Carbon;
use Slack\ValueObjects\Transporter\Payload;
use Slack\Contracts\Resources\ReactionContract;
use Slack\Responses\Reaction\AddReactionResponse;

final class Reaction implements ReactionContract
{
    use Concerns\Transportable;

    /**
     * Adds a reaction to an item.
     *
     * @see https://api.slack.com/methods/reactions.add
     *
     * @param  array<string, mixed>  $parameters
     */
    public function add(string $channel, string $name, string|DateTime $timestamp, array $parameters = []): AddReactionResponse
    {
        $timestamp = is_string($timestamp) ? Carbon::createFromTimestamp($timestamp) : $timestamp;

        $payload = Payload::post('reactions.add', ['channel' => $channel, 'name' => $name, 'timestamp' => $timestamp->format('U.u'), ...$parameters]);

        /** @var array{ok: bool} $result */
        $result = $this->transporter->requestObject($payload);

        return AddReactionResponse::from($result);
    }
}
