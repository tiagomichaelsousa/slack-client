<?php

declare(strict_types=1);

namespace Slack\Responses\User;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;
use Slack\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{ok: bool, presence: string, online: ?bool, auto_away: ?bool, manual_away: ?bool, connection_count: ?int, last_activity: ?int}>
 */
final class GetUserPresenceResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{ok: bool, presence: string, online: ?bool, auto_away: ?bool, manual_away: ?bool, connection_count: ?int, last_activity: ?int}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly bool $ok,
        public readonly string $presence,
        public readonly ?bool $online,
        public readonly ?bool $autoAway,
        public readonly ?bool $manualAway,
        public readonly ?int $connectionCount,
        public readonly ?int $lastActivity,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{ok: bool, presence: string, online: ?bool, auto_away: ?bool, manual_away: ?bool, connection_count: ?int, last_activity: ?int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['ok'],
            $attributes['presence'],
            $attributes['online'] ?? null,
            $attributes['auto_away'] ?? null,
            $attributes['manual_away'] ?? null,
            $attributes['connection_count'] ?? null,
            $attributes['last_activity'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'ok' => $this->ok,
            'presence' => $this->presence,
            'online' => $this->online,
            'auto_away' => $this->autoAway,
            'manual_away' => $this->manualAway,
            'connection_count' => $this->connectionCount,
            'last_activity' => $this->lastActivity,
        ];
    }
}
