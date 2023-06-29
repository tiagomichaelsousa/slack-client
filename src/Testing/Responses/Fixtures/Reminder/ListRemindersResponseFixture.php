<?php

namespace Slack\Testing\Responses\Fixtures\Reminder;

final class ListRemindersResponseFixture
{
    public const ATTRIBUTES = [
        'ok' => true,
        'reminders' => [
            [
                'id' => 'Rm12345678',
                'creator' => 'U18888888',
                'user' => 'U18888888',
                'text' => 'eat a banana',
                'recurring' => false,
                'time' => 1_602_288_000,
                'complete_ts' => 0,
            ],
            [
                'id' => 'Rm12345628',
                'creator' => 'U18888888',
                'user' => 'U18888888',
                'text' => 'eat a cupcake',
                'recurring' => true,
                'time' => 1_602_288_000,
                'complete_ts' => 0,
            ],
        ],
    ];
}
