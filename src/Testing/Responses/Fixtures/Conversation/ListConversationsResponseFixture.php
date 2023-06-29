<?php

namespace Slack\Testing\Responses\Fixtures\Conversation;

final class ListConversationsResponseFixture
{
    public const ATTRIBUTES = [
        'ok' => true,
        'channels' => [
            [
                'id' => 'G0AKFJBEU',
                'name' => 'mpdm-mr.banks--slactions-jackson--beforebot-1',
                'is_channel' => false,
                'is_group' => true,
                'is_im' => false,
                'created' => 1_493_657_761,
                'creator' => 'U061F7AUR',
                'is_archived' => false,
                'is_general' => false,
                'unlinked' => 0,
                'name_normalized' => 'mpdm-mr.banks--slactions-jackson--beforebot-1',
                'is_shared' => false,
                'is_ext_shared' => false,
                'is_org_shared' => false,
                'is_pending_ext_shared' => false,
                'is_member' => true,
                'is_private' => true,
                'is_mpim' => true,
                'updated' => 1_678_229_664_302,
                'topic' => [
                    'value' => 'Group messaging',
                    'creator' => 'U061F7AUR',
                    'last_set' => 1_493_657_761,
                ],
                'purpose' => [
                    'value' => 'Group messaging with: @mr.banks @slactions-jackson @beforebot',
                    'creator' => 'U061F7AUR',
                    'last_set' => 1_493_657_761,
                ],
                'previous_names' => [
                    'specifics',
                    'abstractions',
                    'etc',
                ],
                'num_members' => 3,
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
                'is_member' => true,
                'is_private' => false,
                'is_mpim' => false,
                'updated' => 1_678_229_664_302,
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
                'num_members' => 4,
            ],
        ],
        // 'response_metadata' => [
        //     'next_cursor' => 'aW1faWQ6RDBCSDk1RExI',
        // ],
    ];
}
