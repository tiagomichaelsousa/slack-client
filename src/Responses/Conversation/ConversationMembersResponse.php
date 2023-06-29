<?php

declare(strict_types=1);

namespace Slack\Responses\Conversation;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;
use Slack\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{ok: bool, members: array<int, string>}>
 */
final class ConversationMembersResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{ok: bool, members: array<int, string>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, string>  $members
     */
    private function __construct(
        public readonly bool $ok,
        public readonly array $members,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{ok: bool, members: array<int, string>}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['ok'],
            $attributes['members']
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'ok' => $this->ok,
            'members' => $this->members,
        ];
    }
}
