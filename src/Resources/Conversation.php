<?php

declare(strict_types=1);

namespace Slack\Resources;

use Slack\ValueObjects\Transporter\Payload;
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

final class Conversation implements ConversationContract
{
    use Concerns\Transportable;

    /**
     * Lists all channels in a Slack team.
     *
     * @see https://api.slack.com/methods/conversations.list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): ListConversationsResponse
    {
        $payload = Payload::get('conversations.list', $parameters);

        /** @var array{ok: bool, channels: array<int, array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: array<int, string>, num_members: int}>} $result */
        $result = $this->transporter->requestObject($payload);

        return ListConversationsResponse::from($result);
    }

    /**
     * Retrieve information about a conversation.
     *
     * @see https://api.slack.com/methods/conversations.info
     *
     * @param  array<string, mixed>  $parameters
     */
    public function info(string $channel, array $parameters = []): ConversationInfoResponse
    {
        $payload = Payload::get('conversations.info', [...$parameters, 'channel' => $channel]);

        /** @var array{ok: bool, channel: array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: ?int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: array<int, string>, num_members: ?int}} $result */
        $result = $this->transporter->requestObject($payload);

        return ConversationInfoResponse::from($result);
    }

    /**
     * Removes a user from a conversation.
     *
     * @see https://api.slack.com/methods/conversations.kick
     */
    public function kick(string $channel, string $user): KickUserFromConversationResponse
    {
        $payload = Payload::post('conversations.kick', ['channel' => $channel, 'user' => $user]);

        /** @var array{ok: bool} $result */
        $result = $this->transporter->requestObject($payload);

        return KickUserFromConversationResponse::from($result);
    }

    /**
     * Retrieve members of a conversation.
     *
     * @see https://api.slack.com/methods/conversations.members
     *
     * @param  array<string, mixed>  $parameters
     */
    public function members(string $channel, array $parameters = []): ConversationMembersResponse
    {
        $payload = Payload::get('conversations.members', [...$parameters, 'channel' => $channel]);

        /** @var array{ok: bool, members: array<int, string>} $result */
        $result = $this->transporter->requestObject($payload);

        return ConversationMembersResponse::from($result);
    }

    /**
     * Invites users to a channel.
     *
     * @see https://api.slack.com/methods/conversations.invite
     *
     * @param  array<int, string>|string  $users
     * @param  array<string, mixed>  $parameters
     */
    public function invite(string $channel, array|string $users, array $parameters = []): InviteConversationResponse
    {
        $users = is_array($users) ? implode(',', $users) : $users;

        $payload = Payload::post('conversations.invite', [...$parameters, 'channel' => $channel, 'users' => $users]);

        /** @var array{ok: bool, channel: array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: ?int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: array<int, string>, num_members: ?int}} $result */
        $result = $this->transporter->requestObject($payload);

        return InviteConversationResponse::from($result);
    }

    /**
     * Initiates a public or private channel-based conversation
     *
     * @see https://api.slack.com/methods/conversations.create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $name, array $parameters = []): CreateConversationResponse
    {
        $payload = Payload::post('conversations.create', [...$parameters, 'name' => $name]);

        /** @var array{ok: bool, channel: array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: ?int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: array<int, string>, num_members: ?int}} $result */
        $result = $this->transporter->requestObject($payload);

        return CreateConversationResponse::from($result);
    }

    /**
     * Joins an existing conversation.
     *
     * @see https://api.slack.com/methods/conversations.join
     */
    public function join(string $channel): JoinConversationResponse
    {
        $payload = Payload::post('conversations.join', ['channel' => $channel]);

        /** @var array{ok: bool, channel: array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: ?int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: array<int, string>, num_members: ?int}} $result */
        $result = $this->transporter->requestObject($payload);

        return JoinConversationResponse::from($result);
    }

    /**
     * Archives a conversation.
     *
     * @see https://api.slack.com/methods/conversations.archive
     */
    public function archive(string $channel): ArchiveConversationResponse
    {
        $payload = Payload::post('conversations.archive', ['channel' => $channel]);

        /** @var array{ok: bool} $result */
        $result = $this->transporter->requestObject($payload);

        return ArchiveConversationResponse::from($result);
    }

    /**
     * Reverses conversation archival.
     *
     * @see https://api.slack.com/methods/conversations.unarchive
     */
    public function unarchive(string $channel): UnarchiveConversationResponse
    {
        $payload = Payload::post('conversations.unarchive', ['channel' => $channel]);

        /** @var array{ok: bool} $result */
        $result = $this->transporter->requestObject($payload);

        return UnarchiveConversationResponse::from($result);
    }

    /**
     * Closes a direct message or multi-person direct message.
     *
     * @see https://api.slack.com/methods/conversations.close
     */
    public function close(string $channel): CloseConversationResponse
    {
        $payload = Payload::post('conversations.close', ['channel' => $channel]);

        /** @var array{ok: bool} $result */
        $result = $this->transporter->requestObject($payload);

        return CloseConversationResponse::from($result);
    }

    /**
     * Renames a conversation.
     *
     * @see https://api.slack.com/methods/conversations.rename
     */
    public function rename(string $channel, string $name): RenameConversationResponse
    {
        $payload = Payload::post('conversations.rename', ['channel' => $channel, 'name' => $name]);

        /** @var array{ok: bool, channel: array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: ?int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: array<int, string>, num_members: ?int}} $result */
        $result = $this->transporter->requestObject($payload);

        return RenameConversationResponse::from($result);
    }

    /**
     * Sets the topic for a conversation.
     *
     * @see https://api.slack.com/methods/conversations.setTopic
     */
    public function setTopic(string $channel, string $topic): SetConversationTopicResponse
    {
        $payload = Payload::post('conversations.setTopic', ['channel' => $channel, 'topic' => $topic]);

        /** @var array{ok: bool, channel: array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: ?int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: array<int, string>, num_members: ?int}} $result */
        $result = $this->transporter->requestObject($payload);

        return SetConversationTopicResponse::from($result);
    }

    /**
     * Sets the purpose for a conversation.
     *
     * @see https://api.slack.com/methods/conversations.setPurpose
     */
    public function setPurpose(string $channel, string $purpose): SetConversationPurposeResponse
    {
        $payload = Payload::post('conversations.setPurpose', ['channel' => $channel, 'purpose' => $purpose]);

        /** @var array{ok: bool, channel: array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: ?int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: array<int, string>, num_members: ?int}} $result */
        $result = $this->transporter->requestObject($payload);

        return SetConversationPurposeResponse::from($result);
    }
}
