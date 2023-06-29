<?php

declare(strict_types=1);

namespace Slack\Responses\User;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;

/**
 * @implements ResponseContract<array{title: string, phone: string, skype: string, real_name: string, real_name_normalized: string, display_name: string, display_name_normalized: string, status_text: string, status_emoji: string, status_expiration: int, avatar_hash: string, start_date: ?string, email: string, pronouns: ?string, huddle_state: ?string, huddle_state_expiration_ts: ?int, first_name: string, last_name: string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string}>
 */
final class Profile implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{title: string, phone: string, skype: string, real_name: string, real_name_normalized: string, display_name: string, display_name_normalized: string, status_text: string, status_emoji: string, status_expiration: int, avatar_hash: string, start_date: ?string, email: string, pronouns: ?string, huddle_state: ?string, huddle_state_expiration_ts: ?int, first_name: string, last_name: string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string}>
     */
    use ArrayAccessible;

    private function __construct(
        public readonly string $title,
        public readonly string $phone,
        public readonly string $skype,
        public readonly string $realName,
        public readonly string $realNameNormalized,
        public readonly string $displayName,
        public readonly string $displayNameNormalized,
        //fields
        public readonly string $statusText,
        public readonly string $statusEmoji,
        // public readonly string $statusEmojiDisplayInfo,
        public readonly int $statusExpiration,
        public readonly string $avatarHash,
        public readonly ?string $startDate,
        public readonly string $email,
        public readonly ?string $pronouns,
        public readonly ?string $huddleState,
        public readonly ?int $huddleStateExpirationTs,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $image24,
        public readonly string $image32,
        public readonly string $image48,
        public readonly string $image72,
        public readonly string $image192,
        public readonly string $image512,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{title: string, phone: string, skype: string, real_name: string, real_name_normalized: string, display_name: string, display_name_normalized: string, status_text: string, status_emoji: string, status_expiration: int, avatar_hash: string, start_date: ?string, email: string, pronouns: ?string, huddle_state: ?string, huddle_state_expiration_ts: ?int, first_name: string, last_name: string, image_24: string, image_32: string, image_48: string, image_72: string, image_192: string, image_512: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['title'],
            $attributes['phone'],
            $attributes['skype'],
            $attributes['real_name'],
            $attributes['real_name_normalized'],
            $attributes['display_name'],
            $attributes['display_name_normalized'],
            $attributes['status_text'],
            $attributes['status_emoji'],
            $attributes['status_expiration'],
            $attributes['avatar_hash'],
            $attributes['start_date'] ?? null,
            $attributes['email'],
            $attributes['pronouns'] ?? null,
            $attributes['huddle_state'] ?? null,
            $attributes['huddle_state_expiration_ts'] ?? null,
            $attributes['first_name'],
            $attributes['last_name'],
            $attributes['image_24'],
            $attributes['image_32'],
            $attributes['image_48'],
            $attributes['image_72'],
            $attributes['image_192'],
            $attributes['image_512'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'phone' => $this->phone,
            'skype' => $this->skype,
            'real_name' => $this->realName,
            'real_name_normalized' => $this->realNameNormalized,
            'display_name' => $this->displayName,
            'display_name_normalized' => $this->displayNameNormalized,
            'status_text' => $this->statusText,
            'status_emoji' => $this->statusEmoji,
            'status_expiration' => $this->statusExpiration,
            'avatar_hash' => $this->avatarHash,
            'start_date' => $this->startDate,
            'email' => $this->email,
            'pronouns' => $this->pronouns,
            'huddle_state' => $this->huddleState,
            'huddle_state_expiration_ts' => $this->huddleStateExpirationTs,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'image_24' => $this->image24,
            'image_32' => $this->image32,
            'image_48' => $this->image48,
            'image_72' => $this->image72,
            'image_192' => $this->image192,
            'image_512' => $this->image512,
        ];
    }
}
