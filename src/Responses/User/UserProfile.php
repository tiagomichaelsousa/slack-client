<?php

declare(strict_types=1);

namespace Slack\Responses\User;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{avatar_hash: string, status_text: ?string, status_emoji: ?string, real_name: string, display_name: string, real_name_normalized: string, display_name_normalized: string, email: ?string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string, team: ?string}>
 */
final class UserProfile implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{avatar_hash: string, status_text: ?string, status_emoji: ?string, real_name: string, display_name: string, real_name_normalized: string, display_name_normalized: string, email: ?string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string, team: ?string}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $avatarHash,
        public readonly ?string $statusText,
        public readonly ?string $statusEmoji,
        public readonly string $realName,
        public readonly string $displayName,
        public readonly string $realNameNormalized,
        public readonly string $displayNameNormalized,
        public readonly ?string $email,
        public readonly string $image24,
        public readonly string $image32,
        public readonly string $image48,
        public readonly string $image72,
        public readonly string $image192,
        public readonly string $image512,
        public readonly ?string $team,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{avatar_hash: string, status_text: ?string, status_emoji: ?string, real_name: string, display_name: string, real_name_normalized: string, display_name_normalized: string, email: ?string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string, team: ?string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['avatar_hash'],
            $attributes['status_text'] ?? null,
            $attributes['status_emoji'] ?? null,
            $attributes['real_name'],
            $attributes['display_name'],
            $attributes['real_name_normalized'],
            $attributes['display_name_normalized'],
            $attributes['email'] ?? "",
            $attributes['image_24'],
            $attributes['image_32'],
            $attributes['image_48'],
            $attributes['image_72'],
            $attributes['image_192'],
            $attributes['image_512'],
            $attributes['team'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'avatar_hash' => $this->avatarHash,
            'status_text' => $this->statusText,
            'status_emoji' => $this->statusEmoji,
            'real_name' => $this->realName,
            'display_name' => $this->displayName,
            'real_name_normalized' => $this->realNameNormalized,
            'display_name_normalized' => $this->displayNameNormalized,
            'email' => $this->email,
            'image_24' => $this->image24,
            'image_32' => $this->image32,
            'image_48' => $this->image48,
            'image_72' => $this->image72,
            'image_192' => $this->image192,
            'image_512' => $this->image512,
            'team' => $this->team,
        ];
    }
}
