<?php

use Carbon\Carbon;
use Slack\Responses\Reaction\AddReactionResponse;

test('add', function () {
    $fake = AddReactionResponse::fake();
    $client = mockClient('POST', 'reactions.add', [], $fake->toArray());

    $result = $client->reactions()->add('channel', 'thumbsup', Carbon::now());

    expect($result)
        ->toBeInstanceOf(AddReactionResponse::class)
        ->ok->toBeTruthy();
});
