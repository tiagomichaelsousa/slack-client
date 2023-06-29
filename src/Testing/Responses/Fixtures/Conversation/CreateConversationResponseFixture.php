<?php

namespace Slack\Testing\Responses\Fixtures\Conversation;

final class CreateConversationResponseFixture
{
    public const ATTRIBUTES = [
        'ok' => true,
        'channel' => [
            'id' => 'C0EAQDV4Z',
            'name' => 'endeavor',
            'is_channel' => true,
            'is_group' => false,
            'is_im' => false,
            'created' => 1_504_554_479,
            'creator' => 'U0123456',
            'is_archived' => false,
            'is_general' => false,
            'unlinked' => 0,
            'name_normalized' => 'endeavor',
            'is_shared' => false,
            'is_ext_shared' => false,
            'is_org_shared' => false,
            'is_pending_ext_shared' => false,
            'is_member' => true,
            'is_private' => false,
            'is_mpim' => false,
            'updated' => null,
            'topic' => [
                'value' => '',
                'creator' => '',
                'last_set' => 0,
            ],
            'purpose' => [
                'value' => '',
                'creator' => '',
                'last_set' => 0,
            ],
            'previous_names' => [],
            'num_members' => null,
        ],
    ];
}
