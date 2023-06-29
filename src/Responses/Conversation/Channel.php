<?php

declare(strict_types=1);

namespace Slack\Responses\Conversation;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: ?int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: ?array<int, string>, num_members: ?int}>
 */
final class Channel implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: ?int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: ?array<int, string>, num_members: ?int}>
     */
    use ArrayAccessible;

    /**
     * @param  string[]|null  $previousNames
     */
    private function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly bool $isChannel,
        public readonly bool $isGroup,
        public readonly bool $isIm,
        public readonly int $created,
        public readonly string $creator,
        public readonly bool $isArchived,
        public readonly bool $isGeneral,
        public readonly int $unlinked,
        public readonly string $nameNormalized,
        public readonly bool $isShared,
        public readonly bool $isExtShared,
        public readonly bool $isOrgShared,
        // public readonly string $pendingShared,
        public readonly bool $isPendingExtShared,
        public readonly ?bool $isMember,
        public readonly bool $isPrivate,
        public readonly bool $isMpim,
        public readonly ?int $updated,
        public readonly ChannelTopic $topic,
        public readonly ChannelPurpose $purpose,
        public readonly ?array $previousNames,
        public readonly ?int $numMembers,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, name: string, is_channel: bool, is_group: bool, is_im: bool, created: int, creator: string, is_archived: bool, is_general: bool, unlinked: int, name_normalized: string, is_shared: bool, is_ext_shared: bool, is_org_shared: bool, is_pending_ext_shared: bool, is_member: ?bool, is_private: bool, is_mpim: bool, updated: ?int, topic: array{value: string, creator: string, last_set: int}, purpose: array{value: string, creator: string, last_set: int}, previous_names: ?array<int, string>, num_members: ?int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['name'],
            $attributes['is_channel'],
            $attributes['is_group'],
            $attributes['is_im'],
            $attributes['created'],
            $attributes['creator'],
            $attributes['is_archived'],
            $attributes['is_general'],
            $attributes['unlinked'],
            $attributes['name_normalized'],
            $attributes['is_shared'],
            $attributes['is_ext_shared'],
            $attributes['is_org_shared'],
            // $attributes['pendingShared'],
            $attributes['is_pending_ext_shared'],
            $attributes['is_member'] ?? null,
            $attributes['is_private'],
            $attributes['is_mpim'],
            $attributes['updated'] ?? null,
            ChannelTopic::from($attributes['topic']),
            ChannelPurpose::from($attributes['purpose']),
            $attributes['previous_names'] ?? [],
            $attributes['num_members'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_channel' => $this->isChannel,
            'is_group' => $this->isGroup,
            'is_im' => $this->isIm,
            'created' => $this->created,
            'creator' => $this->creator,
            'is_archived' => $this->isArchived,
            'is_general' => $this->isGeneral,
            'unlinked' => $this->unlinked,
            'name_normalized' => $this->nameNormalized,
            'is_shared' => $this->isShared,
            'is_ext_shared' => $this->isExtShared,
            'is_org_shared' => $this->isOrgShared,
            // 'pendingShared' => $this->pendingShared,
            'is_pending_ext_shared' => $this->isPendingExtShared,
            'is_member' => $this->isMember,
            'is_private' => $this->isPrivate,
            'is_mpim' => $this->isMpim,
            'updated' => $this->updated,
            'topic' => $this->topic->toArray(),
            'purpose' => $this->purpose->toArray(),
            'previous_names' => $this->previousNames,
            'num_members' => $this->numMembers,
        ];
    }
}
