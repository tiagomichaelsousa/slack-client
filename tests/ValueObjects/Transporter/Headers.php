<?php

use Slack\ValueObjects\Token;
use Slack\Enums\Transporter\ContentType;
use Slack\ValueObjects\Transporter\Headers;

it('can be created from an API Token', function () {
    $headers = Headers::withAuthorization(Token::from('foo'));

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
    ]);
});

it('can have content/type', function () {
    $headers = Headers::withAuthorization(Token::from('foo'))
        ->withContentType(ContentType::JSON);

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
        'Content-Type' => 'application/json',
    ]);
});
