<?php

namespace Slack\Contracts\Resources;

use DateTime;
use Slack\Responses\Reaction\AddReactionResponse;
use Slack\Responses\Reaction\GetReactionResponse;
use Slack\Responses\Reaction\ListReactionsResponse;
use Slack\Responses\Reaction\RemoveReactionResponse;

interface ReactionContract
{
    /**
     * Adds a reaction to an item.
     *
     * @see https://api.slack.com/methods/reactions.add
     *
     * @param  array<string, mixed>  $parameters
     */
    public function add(string $channel, string $name, string|DateTime $timestamp, array $parameters = []): AddReactionResponse;

    /**
     * Gets reactions for an item.
     *
     * @see https://api.slack.com/methods/reactions.get
     *
     * @param  array<string, mixed>  $parameters
     */
    public function get(string $channel, string|DateTime $timestamp, array $parameters = []): GetReactionResponse;

    /**
     * Lists reactions made by a user.
     *
     * @see https://api.slack.com/methods/reactions.list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): ListReactionsResponse;

    /**
     * Removes a reaction from an item.
     *
     * @see https://api.slack.com/methods/reactions.remove
     *
     * @param  array<string, mixed>  $parameters
     */
    public function remove(string $channel, string $name, string|DateTime $timestamp, array $parameters = []): RemoveReactionResponse;
}
