<?php

declare(strict_types=1);

namespace Slack;

use Slack\Resources\User;
use Slack\Resources\Reminder;
use Slack\Resources\Conversation;
use Slack\Contracts\ClientContract;
use Slack\Contracts\TransporterContract;

final class Client implements ClientContract
{
    /**
     * Creates a Client instance with the given token.
     */
    public function __construct(private readonly TransporterContract $transporter)
    {
        // ..
    }

    /**
     * Methods that are available to the Client in regards to the User resource.
     *
     * @see https://api.slack.com/methods?query=users.&filter=users
     */
    public function users(): User
    {
        return new User($this->transporter);
    }

    /**
     * Methods that are available to the Client in regards to the Conversation resource.
     *
     * @see https://api.slack.com/methods?filter=conversations
     */
    public function conversations(): Conversation
    {
        return new Conversation($this->transporter);
    }

    /**
     * Methods that are available to the Client in regards to the Reminder resource.
     *
     * @see https://api.slack.com/methods?filter=reminders
     */
    public function reminders(): Reminder
    {
        return new Reminder($this->transporter);
    }
}
