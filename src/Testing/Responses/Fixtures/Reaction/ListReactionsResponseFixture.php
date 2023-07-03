<?php

namespace Slack\Testing\Responses\Fixtures\Reaction;

final class ListReactionsResponseFixture
{
    public const ATTRIBUTES = [
        'ok' => true,
        'items' => [
            [
                'type' => 'message',
                'channel' => 'C05F08MAC65',
                'message' => [
                    'type' => 'message',
                    'text' => 'test',
                    'user' => 'U059CDGQ1PS',
                    'ts' => '1688226253.079089',
                    'team' => 'T05886G8F55',
                    'reactions' => [
                        [
                            'name' => '+1',
                            'users' => [
                                'U059CEMMEV6',
                            ],
                            'count' => 1,
                        ],
                        [
                            'name' => 'heart',
                            'users' => [
                                'U059CDGQ1PS',
                            ],
                            'count' => 1,
                        ],
                    ],
                    'permalink' => 'https://xxx.slack.com/archives/xxx/xxx',
                ],
            ],
        ],
        'response_metadata' => [
            'next_cursor' => '',
        ],
    ];
}
