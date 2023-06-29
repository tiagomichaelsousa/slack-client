<?php

declare(strict_types=1);

namespace Slack\Responses\User;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;
use Slack\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{ok: bool, members: array<int, array{id: string, team_id: string, name: string, deleted: bool, color: string, real_name: string, tz: string, tz_label: string, tz_offset: int, profile: array{avatar_hash: string, status_text: ?string, status_emoji: ?string, real_name: string, display_name: string, real_name_normalized: string, display_name_normalized: string, email: ?string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string, team: ?string}, is_admin: bool, is_owner: bool, is_primary_owner: bool, is_restricted: bool, is_ultra_restricted: bool, is_bot: bool, updated: int, is_app_user: ?bool, is_email_confirmed: ?bool, who_can_share_contact_card: ?string, locale: ?string}>}>
 */
final class ListUsersResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{ok: bool, members: array<int, array{id: string, team_id: string, name: string, deleted: bool, color: string, real_name: string, tz: string, tz_label: string, tz_offset: int, profile: array{avatar_hash: string, status_text: ?string, status_emoji: ?string, real_name: string, display_name: string, real_name_normalized: string, display_name_normalized: string, email: ?string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string, team: ?string}, is_admin: bool, is_owner: bool, is_primary_owner: bool, is_restricted: bool, is_ultra_restricted: bool, is_bot: bool, updated: int, is_app_user: ?bool, is_email_confirmed: ?bool, who_can_share_contact_card: ?string, locale: ?string}>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, User>  $members
     */
    private function __construct(
        public readonly bool $ok,
        public readonly array $members,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{ok: bool, members: array<int, array{id: string, team_id: string, name: string, deleted: bool, color: string, real_name: string, tz: string, tz_label: string, tz_offset: int, profile: array{avatar_hash: string, status_text: ?string, status_emoji: ?string, real_name: string, display_name: string, real_name_normalized: string, display_name_normalized: string, email: ?string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string, team: ?string}, is_admin: bool, is_owner: bool, is_primary_owner: bool, is_restricted: bool, is_ultra_restricted: bool, is_bot: bool, updated: int, is_app_user: ?bool, is_email_confirmed: ?bool, who_can_share_contact_card: ?string, locale: ?string}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $members = array_map(fn (array $user): User => User::from(
            $user
        ), $attributes['members']);

        return new self(
            $attributes['ok'],
            $members
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'ok' => $this->ok,
            'members' => array_map(
                static fn (User $user): array => $user->toArray(),
                $this->members,
            ),
        ];
    }
}
