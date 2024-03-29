<?php

namespace Slack\Contracts\Resources;

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

interface ConversationContract
{
    /**
     * Accepts an invitation to a Slack Connect channel.
     *
     * @see https://api.slack.com/methods/conversations.acceptSharedInvite
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function acceptSharedInvite(array $parameters = []): AcceptConversationSharedInviteResponse;
     */

    /**
     * Approves an invitation to a Slack Connect channel
     *
     * @see https://api.slack.com/methods/conversations.approveSharedInvite
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function approveSharedInvite(array $parameters = []): ApproveConversationSharedInviteResponse;
     */

    /**
     * Archives a conversation.
     *
     * @see https://api.slack.com/methods/conversations.archive
     */
    public function archive(string $channel): ArchiveConversationResponse;

    /**
     * Closes a direct message or multi-person direct message.
     *
     * @see https://api.slack.com/methods/conversations.close
     */
    public function close(string $channel): CloseConversationResponse;

    /**
     * Initiates a public or private channel-based conversation
     *
     * @see https://api.slack.com/methods/conversations.create
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $name, array $parameters = []): CreateConversationResponse;

    /**
     * Declines a Slack Connect channel invite.
     *
     * @see https://api.slack.com/methods/conversations.declineSharedInvite
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function declineSharedInvite(array $parameters = []): DeclineConversationSharedInviteResponse;
     */

    /**
     * Fetches a conversation's history of messages and events.
     *
     * @see https://api.slack.com/methods/conversations.history
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function history(array $parameters = []): DeclineConversationSharedInviteResponse;
     */

    /**
     * Retrieve information about a conversation.
     *
     * @see https://api.slack.com/methods/conversations.info
     *
     * @param  array<string, mixed>  $parameters
     */
    public function info(string $channel, array $parameters = []): ConversationInfoResponse;

    /**
     * Invites users to a channel.
     *
     * @see https://api.slack.com/methods/conversations.invite
     *
     * @param  array<int, string>|string  $users
     * @param  array<string, mixed>  $parameters
     */
    public function invite(string $channel, array|string $users, array $parameters = []): InviteConversationResponse;

    /**
     * Sends an invitation to a Slack Connect channel.
     *
     * @see https://api.slack.com/methods/conversations.inviteShared
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function inviteShared(array $parameters = []): InviteConversationSharedResponse;
     */

    /**
     * Joins an existing conversation.
     *
     * @see https://api.slack.com/methods/conversations.join
     */
    public function join(string $channel): JoinConversationResponse;

    /**
     * Removes a user from a conversation.
     *
     * @see https://api.slack.com/methods/conversations.kick
     */
    public function kick(string $channel, string $user): KickUserFromConversationResponse;

    /**
     * Leaves a conversation.
     *
     * @see https://api.slack.com/methods/conversations.leave
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function leave(array $parameters = []): LeaveConversationResponse;
     */

    /**
     * Lists all channels in a Slack team.
     *
     * @see https://api.slack.com/methods/conversations.list
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(array $parameters = []): ListConversationsResponse;

    /**
     * Lists shared channel invites that have been generated or received but have not been approved by all parties.
     *
     * @see https://api.slack.com/methods/conversations.listConnectInvites
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function listConnectInvites(array $parameters = []): ListConversationConnectInvitesResponse;
     */

    /**
     * Sets the read cursor in a channel.
     *
     * @see https://api.slack.com/methods/conversations.mark
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function mark(array $parameters = []): MarkConversationResponse;
     */

    /**
     * Retrieve members of a conversation.
     *
     * @see https://api.slack.com/methods/conversations.members
     *
     * @param  array<string, mixed>  $parameters
     */
    public function members(string $channel, array $parameters = []): ConversationMembersResponse;

    /**
     * Opens or resumes a direct message or multi-person direct message.
     *
     * @see https://api.slack.com/methods/conversations.open
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function open(array $parameters = []): OpenConversationResponse;
     */

    /**
     * Renames a conversation.
     *
     * @see https://api.slack.com/methods/conversations.rename
     */
    public function rename(string $channel, string $name): RenameConversationResponse;

    /**
     * Retrieve a thread of messages posted to a conversation.
     *
     * @see https://api.slack.com/methods/conversations.replies
     *
     * @param  array<string, mixed>  $parameters
     *                                            public function replies(array $parameters = []): RepliesConversationResponse;
     */

    /**
     * Sets the purpose for a conversation.
     *
     * @see https://api.slack.com/methods/conversations.setPurpose
     */
    public function setPurpose(string $channel, string $purpose): SetConversationPurposeResponse;

    /**
     * Sets the topic for a conversation.
     *
     * @see https://api.slack.com/methods/conversations.setTopic
     */
    public function setTopic(string $channel, string $topic): SetConversationTopicResponse;

    /**
     * Reverses conversation archival.
     *
     * @see https://api.slack.com/methods/conversations.unarchive
     */
    public function unarchive(string $channel): UnarchiveConversationResponse;
}
