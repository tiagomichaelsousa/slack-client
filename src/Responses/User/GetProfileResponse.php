<?php

declare(strict_types=1);

namespace Slack\Responses\User;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;
use Slack\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{ok: bool, profile: array{title: string, phone: string, skype: string, real_name: string, real_name_normalized: string, display_name: string, display_name_normalized: string, status_text: string, status_emoji: string, status_expiration: int, avatar_hash: string, start_date: ?string, email: string, pronouns: ?string, huddle_state: ?string, huddle_state_expiration_ts: ?int, first_name: string, last_name: string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string}}>
 */
final class GetProfileResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{ok: bool, profile: array{title: string, phone: string, skype: string, real_name: string, real_name_normalized: string, display_name: string, display_name_normalized: string, status_text: string, status_emoji: string, status_expiration: int, avatar_hash: string, start_date: ?string, email: string, pronouns: ?string, huddle_state: ?string, huddle_state_expiration_ts: ?int, first_name: string, last_name: string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string}}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly bool $ok,
        public readonly Profile $profile,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{ok: bool, profile: array{title: string, phone: string, skype: string, real_name: string, real_name_normalized: string, display_name: string, display_name_normalized: string, status_text: string, status_emoji: string, status_expiration: int, avatar_hash: string, start_date: ?string, email: string, pronouns: ?string, huddle_state: ?string, huddle_state_expiration_ts: ?int, first_name: string, last_name: string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['ok'],
            Profile::from($attributes['profile']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'ok' => $this->ok,
            'profile' => $this->profile->toArray(),
        ];
    }
}
