<?php

namespace Slack\Testing\Responses\Fixtures\User;

final class GetProfileResponseFixture
{
    public const ATTRIBUTES = [
        'ok' => true,
        'profile' => [
            'title' => 'Head of Coffee Production',
            'phone' => '',
            'skype' => '',
            'real_name' => 'John Smith',
            'real_name_normalized' => 'John Smith',
            'display_name' => 'john',
            'display_name_normalized' => 'john',
            'status_text' => 'Watching cold brew steep',
            'status_emoji' => '=>coffee:',
            'status_expiration' => 0,
            'avatar_hash' => '123xyz',
            'start_date' => '2022-03-21',
            'email' => 'johnsmith@example.com',
            'pronouns' => 'they/them/theirs',
            'huddle_state' => 'default_unset',
            'huddle_state_expiration_ts' => 0,
            'first_name' => 'john',
            'last_name' => 'smith',
            'image_24' => 'https://.../...-24.png',
            'image_32' => 'https://.../...-32.png',
            'image_48' => 'https://.../...-48.png',
            'image_72' => 'https://.../...-72.png',
            'image_192' => 'https://.../....-192png',
            'image_512' => 'https://.../...-512.png',
        ],
    ];
}
