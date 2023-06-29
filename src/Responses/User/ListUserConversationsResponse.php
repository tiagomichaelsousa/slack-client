<?php

declare(strict_types=1);

namespace Slack\Responses\User;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Conversation\Channel;
use Slack\Responses\Concerns\ArrayAccessible;
use Slack\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{ok: bool, channels: array<int, array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: ?int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: ?array<int, string>, num_members: ?int}>}>
 */
final class ListUserConversationsResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{ok: bool, channels: array<int, array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: ?int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: ?array<int, string>, num_members: ?int}>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, Channel>  $channels
     */
    private function __construct(
        public readonly bool $ok,
        public readonly array $channels,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{ok: bool, channels: array<int, array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: ?int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: ?array<int, string>, num_members: ?int}>}  $attributes
     */
    public static function from(array $attributes): self
    {
        $channels = array_map(fn (array $user): Channel => Channel::from(
            $user
        ), $attributes['channels']);

        return new self(
            $attributes['ok'],
            $channels
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'ok' => $this->ok,
            'channels' => array_map(
                static fn (Channel $channel): array => $channel->toArray(),
                $this->channels,
            ),
        ];
    }
}
