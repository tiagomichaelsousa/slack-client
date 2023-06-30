<p align="center">
    <img src="https://raw.githubusercontent.com/tiagomichaelsousa/slack-php/main/art/client.png" width="600" alt="Slack PHP">
    <p align="center">
        <a href="https://github.com/tiagomichaelsousa/slack-php/actions"><img alt="GitHub Workflow Status (main)" src="https://github.com/tiagomichaelsousa/slack-laravel/actions/workflows/tests.yml/badge.svg?branch=main"></a>
        <a href="https://packagist.org/packages/tiagomichaelsousa/slack-php"><img alt="Total Downloads" src="https://img.shields.io/packagist/dt/tiagomichaelsousa/slack-php"></a>
        <a href="https://packagist.org/packages/tiagomichaelsousa/slack-php"><img alt="Latest Version" src="https://img.shields.io/packagist/v/tiagomichaelsousa/slack-php"></a>
        <a href="https://packagist.org/packages/tiagomichaelsousa/slack-php"><img alt="License" src="https://img.shields.io/github/license/tiagomichaelsousa/slack-php"></a>
    </p>
</p>

------
**Slack PHP** is a non-official PHP API client that allows you to interact with the [Slack API](https://api.slack.com/methods) ⚡️

> **This package is still under development.** There may have methods that are still not implemented.

<hr />

## Get Started

The official documentation for the Slack Client will be available soon. 👀

Until there you can still explore the SDK development experience with the `users()`, `conversations()` and `reminders()` methods 🚀

> **Requires [PHP 8.1+](https://php.net/releases/)**

First, install Slack PHP via the [Composer](https://getcomposer.org/) package manager:

```bash
composer require tiagomichaelsousa/slack-php
```

After that, you can interact with Slacks's API:

```php
$client = Slack::client($token);

$conversations = $client->conversations()->create('foo');

echo $conversations->channel->name;
```

If necessary, it is possible to configure and create a separate client.

```php
$client = Slack::factory()
    ->withApiKey($token)
    ->withBaseUri('slack.com/api/v2') // default: slack.com/api
    ->withHttpClient($client = new \GuzzleHttp\Client([])) // default: HTTP client found using PSR-18 HTTP Client 
    ->withHttpHeader('X-My-Header', 'foo')
    ->withQueryParam('foo', 'bar')
    ->withStreamHandler(fn (RequestInterface $request): ResponseInterface => $client->send($request, [
        'stream' => true // Allows to provide a custom stream handler for the http client.
    ]))
    ->make();
```

## Testing

This client provides a way to easily fake the API responses through `Slack\Client` class. 

Before using this feature please ensure that you swap the `Slack\Client` with `Slack\Testing\ClientFake` in your test case.

Besides this useful test class, you can also easily generate response objects and provide relevant information based on your use case. All responses have a `fake()` method to easily overwrite the objects.

```php
use Slack\Testing\ClientFake;
use Slack\Responses\Conversation\CreateConversationResponse;

$client = new ClientFake([
    CreateConversationResponse::fake([
        'channel' => [
            'name' => 'foo',
        ],
    ]);
]);

$conversations = $client->conversations()->create('foo');

expect($conversations->channel)->name->toBe('foo');
```

The official documentation for the Slack Client will be available soon. 👀

Slack PHP is an open-sourced software licensed under the **[MIT license](https://opensource.org/licenses/MIT)**.
