<?php

namespace Slack\Testing\Responses\Fixtures\Conversation;

final class ConversationInfoResponseFixture
{
    public const ATTRIBUTES = [
        'ok' => true,
        'channel' => [
            'id' => 'C012AB3CD',
            'name' => 'general',
            'is_channel' => true,
            'is_group' => false,
            'is_im' => false,
            'created' => 1_449_252_889,
            'creator' => 'W012A3BCD',
            'is_archived' => false,
            'is_general' => true,
            'unlinked' => 0,
            'name_normalized' => 'general',
            'is_shared' => false,
            'is_ext_shared' => false,
            'is_org_shared' => false,
            'is_pending_ext_shared' => false,
            'is_member' => true,
            'is_private' => false,
            'is_mpim' => false,
            'updated' => null,
            'topic' => [
                'value' => 'For public discussion of generalities',
                'creator' => 'W012A3BCD',
                'last_set' => 1_449_709_364,
            ],
            'purpose' => [
                'value' => 'This part of the workspace is for fun. Make fun here.',
                'creator' => 'W012A3BCD',
                'last_set' => 1_449_709_364,
            ],
            'previous_names' => [
                'specifics',
                'abstractions',
                'etc',
            ],
            'num_members' => null,
        ],
    ];
}
