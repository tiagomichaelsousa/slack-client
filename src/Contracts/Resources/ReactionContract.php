<?php

namespace Slack\Contracts\Resources;

interface ReactionContract
{
    /**
     * Adds a reaction to an item.
     *
     * @see https://api.slack.com/methods/reactions.add
     *
     * @param  string  $channel
     * @param  string  $name
     * @param  string  $timestamp
     * public function add(string $channel, string $name, string $timestamp): AddReactionResponse;
     */

    /**
     * Gets reactions for an item.
     *
     * @see https://api.slack.com/methods/reactions.get
     *
     * @param  array<string, mixed>  $parameters
     * public function get(array $parameters): GetReactionResponse;
     */

    /**
     * Lists reactions made by a user.
     *
     * @see https://api.slack.com/methods/reactions.list
     *
     * @param  array<string, mixed>  $parameters
     * public function list(array $parameters): ListReactionsResponse;
     */

    /**
     * Lists reactions made by a user.
     *
     * @see https://api.slack.com/methods/reactions.list
     *
     * @param  array<string, mixed>  $parameters
     * public function list(array $parameters): ListReactionsResponse;
     */

    /**
     * Removes a reaction from an item.
     *
     * @see https://api.slack.com/methods/reactions.remove
     *
     * @param  string  $name
     * @param  array<string, mixed>  $parameters
     * public function remove(string $name, array $parameters): DeleteReactionResponse;
     */
}
