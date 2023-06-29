<?php

// Generate test for API key value object...

use Slack\ValueObjects\Token;

it('can be created from a string', function () {
    $apiKey = Token::from('foo');

    expect($apiKey->toString())->toBe('foo');
});
