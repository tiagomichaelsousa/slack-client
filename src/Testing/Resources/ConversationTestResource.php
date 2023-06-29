<?php

namespace Slack\Testing\Resources;

use Slack\Resources\Conversation;
use Slack\Testing\Resources\Concerns\Testable;
use Slack\Contracts\Resources\ConversationContract;
use Slack\Responses\Conversation\ConversationInfoResponse;
use Slack\Responses\Conversation\JoinConversationResponse;
use Slack\Responses\Conversation\CloseConversationResponse;
use Slack\Responses\Conversation\ListConversationsResponse;
use Slack\Responses\Conversation\CreateConversationResponse;
use Slack\Responses\Conversation\InviteConversationResponse;
use Slack\Responses\Conversation\RenameConversationResponse;
use Slack\Responses\Conversation\ArchiveConversationResponse;
use Slack\Responses\Conversation\ConversationMembersResponse;
use Slack\Responses\Conversation\SetConversationTopicResponse;
use Slack\Responses\Conversation\UnarchiveConversationResponse;
use Slack\Responses\Conversation\SetConversationPurposeResponse;
use Slack\Responses\Conversation\KickUserFromConversationResponse;

final class ConversationTestResource implements ConversationContract
{
    use Testable;

    protected function resource(): string
    {
        return Conversation::class;
    }

    public function list(array $parameters = []): ListConversationsResponse
    {
        return $this->record(__FUNCTION__, $parameters);
    }

    public function info(string $channel, array $parameters = []): ConversationInfoResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'channel' => $channel]);
    }

    public function kick(string $channel, string $user): KickUserFromConversationResponse
    {
        return $this->record(__FUNCTION__, ['channel' => $channel, 'user' => $user]);
    }

    public function members(string $channel, array $parameters = []): ConversationMembersResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'channel' => $channel]);
    }

    public function invite(string $channel, array|string $users, array $parameters = []): InviteConversationResponse
    {
        $users = is_array($users) ? implode(',', $users) : $users;

        return $this->record(__FUNCTION__, [...$parameters, 'channel' => $channel, 'users' => $users]);
    }

    public function create(string $name, array $parameters = []): CreateConversationResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'name' => $name]);
    }

    public function join(string $channel, array $parameters = []): JoinConversationResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'channel' => $channel]);
    }

    public function archive(string $channel, array $parameters = []): ArchiveConversationResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'channel' => $channel]);
    }

    public function unarchive(string $channel, array $parameters = []): UnarchiveConversationResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'channel' => $channel]);
    }

    public function close(string $channel, array $parameters = []): CloseConversationResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'channel' => $channel]);
    }

    public function rename(string $channel, string $name, array $parameters = []): RenameConversationResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'channel' => $channel, 'name' => $name]);
    }

    public function setTopic(string $channel, string $topic, array $parameters = []): SetConversationTopicResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'channel' => $channel, 'topic' => $topic]);
    }

    public function setPurpose(string $channel, string $purpose, array $parameters = []): SetConversationPurposeResponse
    {
        return $this->record(__FUNCTION__, [...$parameters, 'channel' => $channel, 'purpose' => $purpose]);
    }
}
