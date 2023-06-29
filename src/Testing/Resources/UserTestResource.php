<?php

namespace Slack\Testing\Resources;

use Slack\Resources\User;
use Slack\Responses\User\UserResponse;
use Slack\Contracts\Resources\UserContract;
use Slack\Responses\User\ListUsersResponse;
use Slack\Responses\User\GetProfileResponse;
use Slack\Testing\Resources\Concerns\Testable;
use Slack\Responses\User\SetUserActiveResponse;
use Slack\Responses\User\DeleteUserPhotoResponse;
use Slack\Responses\User\GetUserPresenceResponse;
use Slack\Responses\User\ListUserConversationsResponse;

final class UserTestResource implements UserContract
{
    use Testable;

    protected function resource(): string
    {
        return User::class;
    }

    public function conversations(string $user, array $parameters = []): ListUserConversationsResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'user' => $user]);
    }

    public function setActive(): SetUserActiveResponse
    {
        return $this->record(__FUNCTION__, []);
    }

    public function getPresence(string $user, array $parameters = []): GetUserPresenceResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'user' => $user]);
    }

    public function deletePhoto(): DeleteUserPhotoResponse
    {
        return $this->record(__FUNCTION__, []);
    }

    public function info(string $user, array $parameters = []): UserResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'user' => $user]);
    }

    public function list(array $parameters = []): ListUsersResponse
    {
        return $this->record(__FUNCTION__, $parameters);
    }

    public function getProfile(string $user, array $parameters = []): GetProfileResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'user' => $user]);
    }
}
