<?php

declare(strict_types=1);

namespace Slack\Responses\User;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{id: string, team_id: string, name: string, deleted: bool, color: string, real_name: string, tz: string, tz_label: string, tz_offset: int, profile: array{avatar_hash: string, status_text: ?string, status_emoji: ?string, real_name: string, display_name: string, real_name_normalized: string, display_name_normalized: string, email: ?string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string, team: ?string}, is_admin: bool, is_owner: bool, is_primary_owner: bool, is_restricted: bool, is_ultra_restricted: bool, is_bot: bool, updated: int, is_app_user: ?bool, is_email_confirmed: ?bool, who_can_share_contact_card: ?string, locale: ?string}>
 */
final class User implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, team_id: string, name: string, deleted: bool, color: string, real_name: string, tz: string, tz_label: string, tz_offset: int, profile: array{avatar_hash: string, status_text: ?string, status_emoji: ?string, real_name: string, display_name: string, real_name_normalized: string, display_name_normalized: string, email: ?string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string, team: ?string}, is_admin: bool, is_owner: bool, is_primary_owner: bool, is_restricted: bool, is_ultra_restricted: bool, is_bot: bool, updated: int, is_app_user: ?bool, is_email_confirmed: ?bool, who_can_share_contact_card: ?string, locale: ?string}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $id,
        public readonly string $teamId,
        public readonly string $name,
        public readonly bool $deleted,
        public readonly string $color,
        public readonly string $realName,
        public readonly string $tz,
        public readonly string $tzLabel,
        public readonly int $tzOffset,
        public readonly UserProfile $profile,
        public readonly bool $isAdmin,
        public readonly bool $isOwner,
        public readonly bool $isPrimaryOwner,
        public readonly bool $isRestricted,
        public readonly bool $isUltraRestricted,
        public readonly bool $isBot,
        public readonly int $updated,
        public readonly ?bool $isAppUser,
        public readonly ?bool $isEmailConfirmed,
        public readonly ?string $whoCanShareContactCard,
        public readonly ?string $locale,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, team_id: string, name: string, deleted: bool, color: string, real_name: string, tz: string, tz_label: string, tz_offset: int, profile: array{avatar_hash: string, status_text: ?string, status_emoji: ?string, real_name: string, display_name: string, real_name_normalized: string, display_name_normalized: string, email: ?string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string, team: ?string}, is_admin: bool, is_owner: bool, is_primary_owner: bool, is_restricted: bool, is_ultra_restricted: bool, is_bot: bool, updated: int, is_app_user: ?bool, is_email_confirmed: ?bool, who_can_share_contact_card: ?string, locale: ?string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['team_id'],
            $attributes['name'],
            $attributes['deleted'],
            $attributes['color'],
            $attributes['real_name'],
            $attributes['tz'],
            $attributes['tz_label'],
            $attributes['tz_offset'],
            UserProfile::from($attributes['profile']),
            $attributes['is_admin'],
            $attributes['is_owner'],
            $attributes['is_primary_owner'],
            $attributes['is_restricted'],
            $attributes['is_ultra_restricted'],
            $attributes['is_bot'],
            $attributes['updated'],
            $attributes['is_app_user'] ?? null,
            $attributes['is_email_confirmed'] ?? null,
            $attributes['who_can_share_contact_card'] ?? null,
            $attributes['locale'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'team_id' => $this->teamId,
            'name' => $this->name,
            'deleted' => $this->deleted,
            'color' => $this->color,
            'real_name' => $this->realName,
            'tz' => $this->tz,
            'tz_label' => $this->tzLabel,
            'tz_offset' => $this->tzOffset,
            'profile' => $this->profile->toArray(),
            'is_admin' => $this->isAdmin,
            'is_owner' => $this->isOwner,
            'is_primary_owner' => $this->isPrimaryOwner,
            'is_restricted' => $this->isRestricted,
            'is_ultra_restricted' => $this->isUltraRestricted,
            'is_bot' => $this->isBot,
            'updated' => $this->updated,
            'is_app_user' => $this->isAppUser,
            'is_email_confirmed' => $this->isEmailConfirmed,
            'who_can_share_contact_card' => $this->whoCanShareContactCard,
            'locale' => $this->locale,
        ];
    }
}
