<?php

namespace Slack\Contracts\Resources;

use Slack\Responses\User\UserResponse;
use Slack\Responses\User\ListUsersResponse;
use Slack\Responses\User\GetProfileResponse;
use Slack\Responses\User\SetUserActiveResponse;
use Slack\Responses\User\DeleteUserPhotoResponse;
use Slack\Responses\User\GetUserPresenceResponse;
use Slack\Responses\User\ListUserConversationsResponse;

interface UserContract
{
    /**
     * List conversations the calling user may access.
     *
     * @see https://api.slack.com/methods/users.conversations
     *
     * @param  array<string, mixed>  $parameters
     */
    public function conversations(string $user, array $parameters = []): ListUserConversationsResponse;

    /**
     * Delete the user profile photo
     *
     * @see https://api.slack.com/methods/users.conversations
     */
    public function deletePhoto(): DeleteUserPhotoResponse;

    /**
     * Gets user presence information.
     *
     * @see https://api.slack.com/methods/users.getPresence
     *
     * @param  array<string, mixed>  $parameters
     */
    public function getPresence(string $user, array $parameters = []): GetUserPresenceResponse;

    /**
     * Get a user's identity.
     *
     * @see https://api.slack.com/methods/users.identity
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function identity(array $parameters): IndetityResponse;
     */

    /**
     * Gets information about a user.
     *
     * @see https://api.slack.com/methods/users.info
     *
     * @param  array<string, mixed>  $parameters
     */
    public function info(string $user, array $parameters = []): UserResponse;

    /**
     * Lists all users in a Slack team.
     *
     * @see https://api.slack.com/methods/users.list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters): ListUsersResponse;

    /**
     * Find a user with an email address.
     *
     * @see https://api.slack.com/methods/users.lookupByEmail
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function lookupByEmail(array $parameters): LookupByEmailResponse;
     */

    /**
     * Marked a user as active. Deprecated and non-functional.
     *
     * @see https://api.slack.com/methods/users.setActive
     */
    public function setActive(): SetUserActiveResponse;

    /**
     * Set the user profile photo
     *
     * @see https://api.slack.com/methods/users.setPhoto
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function setPhoto(array $parameters): SetPhotoResponse;
     */

    /**
     * Manually sets user presence.
     *
     * @see https://api.slack.com/methods/users.setPresence
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function setPresence(array $parameters): TranslationResponse;
     */

    /**
     * Retrieve a user's profile information, including their custom status.
     *
     * @see https://api.slack.com/methods/users.profile.get
     *
     * @param  array<string, mixed>  $parameters
     */
    public function getProfile(string $user, array $parameters): GetProfileResponse;

    /**
     * Set a user's profile information, including custom status.
     *
     * @see https://api.slack.com/methods/users.profile.set
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function setProfile(array $parameters): SetProfileResponse;
     */
}
