<?php

namespace Slack\Testing\Responses\Fixtures\Conversation;

final class JoinConversationResponseFixture
{
    public const ATTRIBUTES = [
        'ok' => true,
        'channel' => [
            'id' => 'C061EG9SL',
            'name' => 'general',
            'is_channel' => true,
            'is_group' => false,
            'is_im' => false,
            'created' => 1_449_252_889,
            'creator' => 'U061F7AUR',
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
                'value' => 'Which widget do you worry about?',
                'creator' => '',
                'last_set' => 0,
            ],
            'purpose' => [
                'value' => 'For widget discussion',
                'creator' => '',
                'last_set' => 0,
            ],
            'previous_names' => [],
            'num_members' => null,
        ],
    ];
}
