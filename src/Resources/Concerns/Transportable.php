<?php

declare(strict_types=1);

namespace Slack\Resources\Concerns;

use Slack\Contracts\TransporterContract;

trait Transportable
{
    /**
     * Creates a Client instance with the given token.
     */
    public function __construct(private readonly TransporterContract $transporter)
    {
        // ..
    }
}
