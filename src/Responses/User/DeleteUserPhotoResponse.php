<?php

declare(strict_types=1);

namespace Slack\Responses\User;

use Slack\Contracts\ResponseContract;
use Slack\Responses\Concerns\ArrayAccessible;
use Slack\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{ok: bool}>
 */
final class DeleteUserPhotoResponse implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{ok: bool}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public readonly bool $ok,
    ) {
    }

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{ok: bool}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['ok'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'ok' => $this->ok,
        ];
    }
}
