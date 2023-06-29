<?php

namespace Slack\Testing\Responses\Fixtures\User;

final class GetUserPresenceResponseFixture
{
    public const ATTRIBUTES = [
        'ok' => true,
        'presence' => 'active',
        'online' => true,
        'auto_away' => false,
        'manual_away' => false,
        'connection_count' => 1,
        'last_activity' => 1_419_027_078,
    ];
}
