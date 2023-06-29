<?php

namespace Slack\Contracts;

use Slack\Contracts\Resources\UserContract;
use Slack\Contracts\Resources\ReminderContract;
use Slack\Contracts\Resources\ConversationContract;

interface ClientContract
{
    /**
     * Methods that are available to the Client in regards to the User resource.
     *
     * @see https://api.slack.com/methods?query=users.&filter=users
     */
    public function users(): UserContract;

    /**
     * Methods that are available to the Client in regards to the Conversation resource.
     *
     * @see https://api.slack.com/methods?filter=conversations
     */
    public function conversations(): ConversationContract;

    /**
     * Methods that are available to the Client in regards to the Reminder resource.
     *
     * @see https://api.slack.com/methods?filter=reminders
     */
    public function reminders(): ReminderContract;
}
