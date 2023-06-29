<?php

use Slack\Slack;
use Slack\Resources\User;
use Slack\Resources\Reminder;
use Slack\Resources\Conversation;

it('has users', function () {
    $slack = Slack::client('foo');

    expect($slack->users())->toBeInstanceOf(User::class);
});

it('has conversations', function () {
    $slack = Slack::client('foo');

    expect($slack->conversations())->toBeInstanceOf(Conversation::class);
});

it('has reminders', function () {
    $slack = Slack::client('foo');

    expect($slack->reminders())->toBeInstanceOf(Reminder::class);
});
