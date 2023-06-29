<?php

namespace Slack\Testing\Responses\Fixtures\User;

final class ListUserConversationsResponseFixture
{
    public const ATTRIBUTES = [
        'ok' => true,
        'channels' => [
            [
                'id' => 'C012AB3CD',
                'name' => 'general',
                'is_channel' => true,
                'is_group' => false,
                'is_im' => false,
                'created' => 1_449_252_889,
                'creator' => 'U012A3CDE',
                'is_archived' => false,
                'is_general' => true,
                'unlinked' => 0,
                'name_normalized' => 'general',
                'is_shared' => false,
                'is_ext_shared' => false,
                'is_org_shared' => false,
                'is_pending_ext_shared' => false,
                'is_member' => null,
                'is_private' => false,
                'is_mpim' => false,
                'updated' => null,
                'topic' => [
                    'value' => 'Company-wide announcements and work-based matters',
                    'creator' => '',
                    'last_set' => 0,
                ],
                'purpose' => [
                    'value' => 'This channel is for team-wide communication and announcements. All team members are in this channel.',
                    'creator' => '',
                    'last_set' => 0,
                ],
                'previous_names' => [],
                'num_members' => null,
            ],
            [
                'id' => 'C061EG9T2',
                'name' => 'random',
                'is_channel' => true,
                'is_group' => false,
                'is_im' => false,
                'created' => 1_449_252_889,
                'creator' => 'U061F7AUR',
                'is_archived' => false,
                'is_general' => false,
                'unlinked' => 0,
                'name_normalized' => 'random',
                'is_shared' => false,
                'is_ext_shared' => false,
                'is_org_shared' => false,
                'is_pending_ext_shared' => false,
                'is_member' => null,
                'is_private' => false,
                'is_mpim' => false,
                'updated' => null,
                'topic' => [
                    'value' => 'Non-work banter and water cooler conversation',
                    'creator' => '',
                    'last_set' => 0,
                ],
                'purpose' => [
                    'value' => "A place for non-work-related flimflam, faffing, hodge-podge or jibber-jabber you'd prefer to keep out of more focused work-related channels.",
                    'creator' => '',
                    'last_set' => 0,
                ],
                'previous_names' => [],
                'num_members' => null,
            ],
        ],
        // 'response_metadata' => [
        //     'next_cursor' => 'aW1faWQ6RDBCSDk1RExI',
        // ],
    ];
}
