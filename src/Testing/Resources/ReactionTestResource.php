<?php

namespace Slack\Testing\Resources;

use DateTime;
use Carbon\Carbon;
use Slack\Resources\Reaction;
use Slack\Testing\Resources\Concerns\Testable;
use Slack\Contracts\Resources\ReactionContract;
use Slack\Responses\Reaction\AddReactionResponse;
use Slack\Responses\Reaction\GetReactionResponse;
use Slack\Responses\Reaction\RemoveReactionResponse;

final class ReactionTestResource implements ReactionContract
{
    use Testable;

    protected function resource(): string
    {
        return Reaction::class;
    }

    public function add(string $channel, string $name, string|DateTime $timestamp, array $parameters = []): AddReactionResponse
    {
        return $this->record(__FUNCTION__, ['channel' => $channel, 'name' => $name, 'timestamp' => (string) Carbon::instance($timestamp)->getTimestamp(), ...$parameters]);
    }

    public function get(string $channel, string|DateTime $timestamp, array $parameters = []): GetReactionResponse
    {
        return $this->record(__FUNCTION__, ['channel' => $channel, 'timestamp' => (string) Carbon::instance($timestamp)->getTimestamp(), ...$parameters]);
    }

    public function remove(string $channel, string $name, string|DateTime $timestamp, array $parameters = []): RemoveReactionResponse
    {
        return $this->record(__FUNCTION__, ['channel' => $channel, 'name' => $name, 'timestamp' => (string) Carbon::instance($timestamp)->getTimestamp(), ...$parameters]);
    }
}
