<?php

declare(strict_types=1);

namespace Slack\Resources;

use DateTime;
use Carbon\Carbon;
use Slack\ValueObjects\Transporter\Payload;
use Slack\Contracts\Resources\ReactionContract;
use Slack\Responses\Reaction\AddReactionResponse;
use Slack\Responses\Reaction\GetReactionResponse;
use Slack\Responses\Reaction\ListReactionsResponse;
use Slack\Responses\Reaction\RemoveReactionResponse;

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

    /**
     * Gets reactions for an item.
     *
     * @see https://api.slack.com/methods/reactions.get
     *
     * @param  array<string, mixed>  $parameters
     */
    public function get(string $channel, string|DateTime $timestamp, array $parameters = []): GetReactionResponse
    {
        $timestamp = is_string($timestamp) ? Carbon::createFromTimestamp($timestamp) : $timestamp;

        $payload = Payload::get('reactions.get', ['channel' => $channel, 'timestamp' => $timestamp->format('U.u'), ...$parameters]);

        /** @var array{ok: bool, type: string, message: array{type: string, text: string, user: string, ts: string, team: string, reactions: array<int, array{name: string, users: array<int, string>, count: int}>, permalink: string}, channel: string} $result */
        $result = $this->transporter->requestObject($payload);

        return GetReactionResponse::from($result);
    }

    /**
     * Lists reactions made by a user.
     *
     * @see https://api.slack.com/methods/reactions.list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): ListReactionsResponse
    {
        $payload = Payload::get('reactions.list', $parameters);

        /** @var array{ok: bool, items: array<int, array{type: string, channel: string, message: array{type: string, text: string, user: string, ts: string, team: string, reactions: array<int, array{name: string, users: array<int, string>, count: int}>, permalink: string}}>, response_metadata: array{next_cursor: string}} $result */
        $result = $this->transporter->requestObject($payload);

        return ListReactionsResponse::from($result);
    }

    /**
     * Removes a reaction from an item.
     *
     * @see https://api.slack.com/methods/reactions.remove
     *
     * @param  array<string, mixed>  $parameters
     */
    public function remove(string $channel, string $name, string|DateTime $timestamp, array $parameters = []): RemoveReactionResponse
    {
        $timestamp = is_string($timestamp) ? Carbon::createFromTimestamp($timestamp) : $timestamp;

        $payload = Payload::post('reactions.remove', ['channel' => $channel, 'name' => $name, 'timestamp' => $timestamp->format('U.u'), ...$parameters]);

        /** @var array{ok: bool} $result */
        $result = $this->transporter->requestObject($payload);

        return RemoveReactionResponse::from($result);
    }
}
