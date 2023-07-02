<?php

namespace Slack\Testing\Responses\Fixtures\Reaction;

final class GetReactionResponseFixture
{
    public const ATTRIBUTES = [
        'ok' => true,
        'type' => 'message',
        'message' => [
            'type' => 'message',
            'text' => 'Hi there!',
            'user' => 'W123456',
            'ts' => '1648602352.215969',
            'team' => 'T123456',
            'reactions' => [
                [
                    'name' => 'grinning',
                    'users' => [
                        'W222222',
                    ],
                    'count' => 1,
                ],
                [
                    'name' => 'question',
                    'users' => [
                        'W333333',
                    ],
                    'count' => 1,
                ],
            ],
            'permalink' => 'https://xxx.slack.com/archives/C123456/p1648602352215969',
        ],
        'channel' => 'C123ABC456',
    ];
}
