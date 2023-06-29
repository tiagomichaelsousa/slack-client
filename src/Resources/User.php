<?php

declare(strict_types=1);

namespace Slack\Resources;

use Slack\Responses\User\UserResponse;
use Slack\Contracts\Resources\UserContract;
use Slack\Responses\User\ListUsersResponse;
use Slack\ValueObjects\Transporter\Payload;
use Slack\Responses\User\GetProfileResponse;
use Slack\Responses\User\SetUserActiveResponse;
use Slack\Responses\User\DeleteUserPhotoResponse;
use Slack\Responses\User\GetUserPresenceResponse;
use Slack\Responses\User\ListUserConversationsResponse;

final class User implements UserContract
{
    use Concerns\Transportable;

    /**
     * List conversations the calling user may access.
     *
     * @see https://api.slack.com/methods/users.conversations
     *
     * @param  array<string, mixed>  $parameters
     */
    public function conversations(string $user, array $parameters = []): ListUserConversationsResponse
    {
        $payload = Payload::get('users.conversations', [...$parameters, 'user' => $user]);

        /** @var array{ok: bool, channels: array<int, array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: array<int, string>, num_members: int}>} $result */
        $result = $this->transporter->requestObject($payload);

        return ListUserConversationsResponse::from($result);
    }

    /**
     * Delete the user profile photo
     *
     * @see https://api.slack.com/methods/users.conversations
     */
    public function deletePhoto(): DeleteUserPhotoResponse
    {
        $payload = Payload::post('users.deletePhoto', []);

        /** @var array{ok: bool} $result */
        $result = $this->transporter->requestObject($payload);

        return DeleteUserPhotoResponse::from($result);
    }

    /**
     * Gets user presence information.
     *
     * @see https://api.slack.com/methods/users.getPresence
     *
     * @param  array<string, mixed>  $parameters
     */
    public function getPresence(string $user, array $parameters = []): GetUserPresenceResponse
    {
        $payload = Payload::get('users.getPresence', [...$parameters, 'user' => $user]);

        /** @var array{ok: bool, presence: string, online: ?bool, auto_away: ?bool, manual_away: ?bool, connection_count: ?int, last_activity: ?int} $result */
        $result = $this->transporter->requestObject($payload);

        return GetUserPresenceResponse::from($result);
    }

    /**
     * Gets information about a user.
     *
     * @see https://api.slack.com/methods/users.info
     *
     * @param  array<string, mixed>  $parameters
     */
    public function info(string $user, array $parameters = []): UserResponse
    {
        $payload = Payload::get('users.info', [...$parameters, 'user' => $user]);

        /** @var array{ok: bool, user: array{id: string, team_id: string, name: string, deleted: bool, color: string, real_name: string, tz: string, tz_label: string, tz_offset: int, profile: array{avatar_hash: string, status_text: string, status_emoji: string, real_name: string, display_name: string, real_name_normalized: string, display_name_normalized: string, email: string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string, team: string}, is_admin: bool, is_owner: bool, is_primary_owner: bool, is_restricted: bool, is_ultra_restricted: bool, is_bot: bool, updated: int, is_app_user: bool, is_email_confirmed: bool, who_can_share_contact_card: string, locale: string|null}} $result */
        $result = $this->transporter->requestObject($payload);

        return UserResponse::from($result);
    }

    /**
     * Lists all users in a Slack team.
     *
     * @see https://api.slack.com/methods/users.list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): ListUsersResponse
    {
        $payload = Payload::get('users.list', $parameters);

        /** @var array{ok: bool, members: array<int, array{id: string, team_id: string, name: string, deleted: bool, color: string, real_name: string, tz: string, tz_label: string, tz_offset: int, profile: array{avatar_hash: string, status_text: ?string, status_emoji: ?string, real_name: string, display_name: string, real_name_normalized: string, display_name_normalized: string, email: ?string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string, team: ?string}, is_admin: bool, is_owner: bool, is_primary_owner: bool, is_restricted: bool, is_ultra_restricted: bool, is_bot: bool, updated: int, is_app_user: ?bool, is_email_confirmed: ?bool, who_can_share_contact_card: ?string, locale: ?string}>} $result */
        $result = $this->transporter->requestObject($payload);

        return ListUsersResponse::from($result);
    }

    /**
     * Marked a user as active. Deprecated and non-functional.
     *
     * @see https://api.slack.com/methods/users.setActive
     */
    public function setActive(): SetUserActiveResponse
    {
        $payload = Payload::post('users.setActive', []);

        /** @var array{ok: bool} $result */
        $result = $this->transporter->requestObject($payload);

        return SetUserActiveResponse::from($result);
    }

    /**
     * Retrieve a user's profile information, including their custom status.
     *
     * @see https://api.slack.com/methods/users.profile.get
     *
     * @param  array<string, mixed>  $parameters
     */
    public function getProfile(string $user, array $parameters = []): GetProfileResponse
    {
        $payload = Payload::get('users.profile.get', [...$parameters, 'user' => $user]);

        /** @var array{ok: bool, profile: array{title: string, phone: string, skype: string, real_name: string, real_name_normalized: string, display_name: string, display_name_normalized: string, status_text: string, status_emoji: string, status_expiration: int, avatar_hash: string, start_date: ?string, email: string, pronouns: ?string, huddle_state: ?string, huddle_state_expiration_ts: ?int, first_name: string, last_name: string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string}} $result */
        $result = $this->transporter->requestObject($payload);

        return GetProfileResponse::from($result);
    }
}
