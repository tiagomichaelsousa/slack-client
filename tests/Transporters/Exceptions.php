<?php

use GuzzleHttp\Psr7\Response;
use Slack\ValueObjects\Token;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slack\Transporters\HttpTransporter;
use Slack\Enums\Transporter\ContentType;
use Slack\ValueObjects\Transporter\BaseUri;
use Slack\ValueObjects\Transporter\Headers;
use Slack\ValueObjects\Transporter\Payload;
use Slack\ValueObjects\Transporter\QueryParams;

beforeEach(function () {
    $this->client = Mockery::mock(ClientInterface::class);

    $apiKey = Token::from('foo');

    $this->http = new HttpTransporter(
        $this->client,
        BaseUri::from('slack.com/api/v1'),
        Headers::withAuthorization($apiKey)->withContentType(ContentType::JSON),
        QueryParams::create()->withParam('foo', 'bar'),
        fn (RequestInterface $request): ResponseInterface => $this->client->sendAsyncRequest($request, ['stream' => true]),
    );
});

test('throws an exception', function (string $exceptionClass, string $error, string $message) {
    $payload = Payload::get('users.getProfile', []);
    $fixture = [
        'ok' => false,
        'error' => $error,
    ];

    $response = new Response(401, ['Content-Type' => 'application/json; charset=utf-8'], json_encode($fixture));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    expect(fn () => $this->http->requestObject($payload))
        ->toThrow(function (Slack\Exceptions\ErrorException $exception) use ($error, $message, $exceptionClass) {
            expect($exception)->toBeInstanceOf($exceptionClass)
                ->and($exception->getMessage())->toBe($message)
                ->and($exception->getErrorMessage())->toBe($message)
                ->and($exception->getOk())->toBeFalsy()
                ->and($exception->getError())->toBe($error);
        });
})->with([
    [\Slack\Exceptions\Slack\CannotAddBotException::class, 'cannot_add_bot', "Reminders can't be sent to bots."],
    [\Slack\Exceptions\Slack\CannotAddOthersException::class, 'cannot_add_others', "Guests can't set reminders for other team members."],
    [\Slack\Exceptions\Slack\CannotAddOthersRecurringException::class, 'cannot_add_others_recurring', "Recurring reminders can't be set for other team members."],
    [\Slack\Exceptions\Slack\CannotAddProfileOnlyUserException::class, 'cannot_add_profile_only_user', "Reminders can't be sent to profile only users."],
    [\Slack\Exceptions\Slack\CannotAddSlackbotException::class, 'cannot_add_slackbot', "Reminders can't be sent to Slackbot."],
    [\Slack\Exceptions\Slack\CannotParseException::class, 'cannot_parse', 'The phrasing of the timing for this reminder is unclear. You must include a complete time description. Some examples that work: 1458678068, 20, in 5 minutes, tomorrow, at 3:30pm, on Tuesday, or next week.'],
    [\Slack\Exceptions\Slack\CannotCompleteOthersException::class, 'cannot_complete_others', "Reminders for other team members can't be marked complete."],
    [\Slack\Exceptions\Slack\CannotCompleteRecurringException::class, 'cannot_complete_recurring', "Recurring reminders can't be marked complete."],
    [\Slack\Exceptions\Slack\CantInviteSelfException::class, 'cant_invite_self', 'Authenticated user cannot invite themselves to a channel.'],
    [\Slack\Exceptions\Slack\ChannelNotFoundException::class, 'channel_not_found', 'Value passed for channel was invalid.'],
    [\Slack\Exceptions\Slack\MethodNotSupportedForChannelTypeException::class, 'method_not_supported_for_channel_type', 'This type of conversation cannot be used with this method.'],
    [\Slack\Exceptions\Slack\CantKickFromGeneralException::class, 'cant_kick_from_general', 'User cannot be removed from #general.'],
    [\Slack\Exceptions\Slack\CantKickSelfException::class, 'cant_kick_self', "Authenticated user can't kick themselves from a channel."],
    [\Slack\Exceptions\Slack\NotInChannelException::class, 'not_in_channel', 'User was not in the channel.'],
    [\Slack\Exceptions\Slack\FetchMembersFailedException::class, 'fetch_members_failed', 'Failed to fetch members for the conversation.'],
    [\Slack\Exceptions\Slack\NameTakenException::class, 'name_taken', 'A channel cannot be created with the given name.'],
    [\Slack\Exceptions\Slack\NoChannelException::class, 'no_channel', 'Value passed for name was empty.'],
    [\Slack\Exceptions\Slack\RestrictedActionException::class, 'restricted_action', 'A team preference prevents the authenticated user from creating channels.'],
    [\Slack\Exceptions\Slack\InvalidNameMaxLengthException::class, 'invalid_name_maxlength', 'Value passed for name exceeded max length.'],
    [\Slack\Exceptions\Slack\InvalidNamePunctuationException::class, 'invalid_name_punctuation', 'Value passed for name contained only punctuation.'],
    [\Slack\Exceptions\Slack\InvalidNameRequiredException::class, 'invalid_name_required', 'Value passed for name was empty.'],
    [\Slack\Exceptions\Slack\InvalidNameSpecialsException::class, 'invalid_name_specials', 'Value passed for name contained unallowed special characters or upper case characters.'],
    [\Slack\Exceptions\Slack\CannotCreateChannelException::class, 'cannot_create_channel', 'This channel is unable to be created.'],
    [\Slack\Exceptions\Slack\IsArchivedException::class, 'is_archived', 'Channel has been archived.'],
    [\Slack\Exceptions\Slack\TooManyMembersException::class, 'too_many_members', 'The membership in the channel has exceeded our maximum member limit. No more users can join the channel.'],
    [\Slack\Exceptions\Slack\AlreadyArchivedException::class, 'already_archived', 'Channel has already been archived.'],
    [\Slack\Exceptions\Slack\CantArchiveGeneralException::class, 'cant_archive_general', 'You cannot archive the general channel'],
    [\Slack\Exceptions\Slack\CantArchiveRequiredException::class, 'cant_archive_required', 'You cannot archive a required channel'],
    [\Slack\Exceptions\Slack\NotArchivedException::class, 'not_archived', 'Channel is not archived.'],
    [\Slack\Exceptions\Slack\TooManyUsersException::class, 'too_many_users', 'Too many users.'],
    [\Slack\Exceptions\Slack\UserNotFoundException::class, 'user_not_found', 'User not found'],
    [\Slack\Exceptions\Slack\UserNotVisibleException::class, 'user_not_visible', 'User not visible'],
    [\Slack\Exceptions\Slack\MissingArgumentException::class, 'missing_argument', 'A required argument is missing.'],
    [\Slack\Exceptions\Slack\InvalidCursorException::class, 'invalid_cursor', 'Value passed for cursor was not valid or is no longer valid.'],
    [\Slack\Exceptions\Slack\InvalidLimitException::class, 'invalid_limit', 'Value passed for limit is not understood.'],
    [\Slack\Exceptions\Slack\InvalidTypesException::class, 'invalid_types', "Value passed for type could not be used based on the method's capabilities or the permission scopes granted to the used token."],
    [\Slack\Exceptions\Slack\TeamAccessNotGrantedException::class, 'team_access_not_granted', 'The token used is not granted the specific workspace access required to complete this request.'],
    [\Slack\Exceptions\Slack\AccessDeniedException::class, 'access_denied', 'Access to a resource specified in the request is denied.'],
    [\Slack\Exceptions\Slack\AccountInactiveException::class, 'account_inactive', 'Authentication token is for a deleted user or workspace when using a bot token.'],
    [\Slack\Exceptions\Slack\DeprecatedEndpointException::class, 'deprecated_endpoint', 'The endpoint has been deprecated.'],
    [\Slack\Exceptions\Slack\EkmAccessDeniedException::class, 'ekm_access_denied', 'Administrators have suspended the ability to post a message.'],
    [\Slack\Exceptions\Slack\EnterpriseIsRestrictedException::class, 'enterprise_is_restricted', 'The method cannot be called from an Enterprise.'],
    [\Slack\Exceptions\Slack\InvalidAuthException::class, 'invalid_auth', 'Some aspect of authentication cannot be validated. Either the provided token is invalid or the request originates from an IP address disallowed from making the request.'],
    [\Slack\Exceptions\Slack\MethodDeprecatedException::class, 'method_deprecated', 'The method has been deprecated.'],
    [\Slack\Exceptions\Slack\NotAllowedTokenTypeException::class, 'not_allowed_token_type', 'The token type used in this request is not allowed.'],
    [\Slack\Exceptions\Slack\NotAuthedException::class, 'not_authed', 'No authentication token provided.'],
    [\Slack\Exceptions\Slack\NoPermissionException::class, 'no_permission', "The workspace token used in this request does not have the permissions necessary to complete the request. Make sure your app is a member of the conversation it's attempting to post a message to."],
    [\Slack\Exceptions\Slack\OrgLoginRequiredException::class, 'org_login_required', 'The workspace is undergoing an enterprise migration and will not be available until migration is complete.'],
    [\Slack\Exceptions\Slack\TokenExpiredException::class, 'token_expired', 'Authentication token has expired'],
    [\Slack\Exceptions\Slack\TokenRevokedException::class, 'token_revoked', 'Authentication token is for a deleted user or workspace or the app has been removed when using a user token.'],
    [\Slack\Exceptions\Slack\TwoFactorSetupRequiredException::class, 'two_factor_setup_required', 'Two factor setup is required.'],
    [\Slack\Exceptions\Slack\AccessLimitedException::class, 'accesslimited', 'Access to this method is limited on the current network'],
    [\Slack\Exceptions\Slack\TooManyRequestsException::class, 'too_many_requests', 'Too Many Requests'],
    [\Slack\Exceptions\Slack\FatalErrorException::class, 'fatal_error', "The server could not complete your operation(s) without encountering a catastrophic error. It's possible some aspect of the operation succeeded before the error was raised."],
    [\Slack\Exceptions\Slack\InternalErrorException::class, 'internal_error', "The server could not complete your operation(s) without encountering an error, likely due to a transient issue on our end. It's possible some aspect of the operation succeeded before the error was raised."],
    [\Slack\Exceptions\Slack\InvalidArgNameException::class, 'invalid_arg_name', 'The method was passed an argument whose name falls outside the bounds of accepted or expected values. This includes very long names and names with non-alphanumeric characters other than _. If you get this error, it is typically an indication that you have made a very malformed API call.'],
    [\Slack\Exceptions\Slack\InvalidArgumentsException::class, 'invalid_arguments', 'The method was either called with invalid arguments or some detail about the arguments passed is invalid, which is more likely when using complex arguments like blocks or attachments.'],
    [\Slack\Exceptions\Slack\InvalidArrayArgException::class, 'invalid_array_arg', 'The method was passed an array as an argument. Please only input valid strings.'],
    [\Slack\Exceptions\Slack\InvalidCharsetException::class, 'invalid_charset', 'The method was called via a POST request, but the charset specified in the Content-Type header was invalid. Valid charset names are: utf-8 iso-8859-1'],
    [\Slack\Exceptions\Slack\InvalidFormDataException::class, 'invalid_form_data', 'The method was called via a POST request with Content-Type application/x-www-form-urlencoded or multipart/form-data, but the form data was either missing or syntactically invalid.'],
    [\Slack\Exceptions\Slack\InvalidPostTypeException::class, 'invalid_post_type', 'The method was called via a POST request, but the specified Content-Type was invalid. Valid types are: application/json application/x-www-form-urlencoded multipart/form-data text/plain.'],
    [\Slack\Exceptions\Slack\MissingPostTypeException::class, 'missing_post_type', 'The method was called via a POST request and included a data payload, but the request did not include a Content-Type header.'],
    [\Slack\Exceptions\Slack\RateLimitedException::class, 'ratelimited', 'The request has been rate limited. Refer to the Retry-After header for when to retry the request.'],
    [\Slack\Exceptions\Slack\RequestTimeoutException::class, 'request_timeout', 'The method was called via a POST request, but the POST data was either missing or truncated.'],
    [\Slack\Exceptions\Slack\ServiceUnavailableException::class, 'service_unavailable', 'The service is temporarily unavailable'],
    [\Slack\Exceptions\Slack\NotFoundException::class, 'not_found', 'Resource not found'],
    [\Slack\Exceptions\Slack\AlreadyReactedException::class, 'already_reacted', 'The specified item already has the user/reaction combination.'],
    [\Slack\Exceptions\Slack\ExternalChannelMigratingException::class, 'external_channel_migrating', 'The channel is in the process of being migrated.'],
    [\Slack\Exceptions\Slack\MessageNotFoundException::class, 'message_not_found', 'Message specified by channel and timestamp does not exist.'],
    [\Slack\Exceptions\Slack\NoItemSpecifiedException::class, 'no_item_specified', 'Combination of channel and timestamp was not specified.'],
    [\Slack\Exceptions\Slack\NotReactableException::class, 'not_reactable', "Whatever you passed in, like a file or file_comment, can't be reacted to anymore. Your app can react to messages though."],
    [\Slack\Exceptions\Slack\ThreadLockedException::class, 'thread_locked', 'Reactions are disabled as the specified message is part of a locked thread.'],
    [\Slack\Exceptions\Slack\TooManyEmojiException::class, 'too_many_emoji', 'The limit for distinct reactions (i.e emoji) on the item has been reached.'],
    [\Slack\Exceptions\Slack\TooManyReactionsException::class, 'too_many_reactions', 'The limit for reactions a person may add to the item has been reached.'],
    [\Slack\Exceptions\Slack\InvalidNameException::class, 'invalid_name', 'Value passed for name was invalid.'],
    [\Slack\Exceptions\Slack\BadTimestampException::class, 'bad_timestamp', 'Value passed for timestamp was invalid.'],
    [\Slack\Exceptions\Slack\TeamAddedToOrgException::class, 'team_added_to_org', 'The workspace associated with your request is currently undergoing migration to an Enterprise Organization. Web API and other platform operations will be intermittently unavailable until the transition is complete.'],
    [\Slack\Exceptions\Slack\FileNotFoundException::class, 'file_not_found', 'File specified by file does not exist.'],
    [\Slack\Exceptions\Slack\FileCommentNotFoundException::class, 'file_comment_not_found', 'File comment specified by file_comment does not exist.'],
    [\Slack\Exceptions\Slack\NoReactionException::class, 'no_reaction', 'The specified reaction does not exist, or the requestor is not the original reaction author.'],
]);

test('throws an exception for MissingScopeException', function () {
    $payload = Payload::get('users.getProfile', []);
    $fixture = [
        'ok' => false,
        'error' => 'missing_scope',
        'provided' => 'users.profile:read',
        'needed' => 'users.profile:write',
    ];

    $response = new Response(401, ['Content-Type' => 'application/json; charset=utf-8'], json_encode($fixture));

    $this->client
        ->shouldReceive('sendRequest')
        ->once()
        ->andReturn($response);

    $message = 'The token used is not granted the specific scope permissions required to complete this request.'.PHP_EOL.PHP_EOL;
    $message .= 'Provided: '.$fixture['provided'].PHP_EOL;
    $message .= 'Needed: '.$fixture['needed'].PHP_EOL;

    expect(fn () => $this->http->requestObject($payload))
        ->toThrow(function (Slack\Exceptions\Slack\MissingScopeException $exception) use ($message) {
            expect($exception)->toBeInstanceOf(\Slack\Exceptions\Slack\MissingScopeException::class)
                ->and($exception->getMessage())->toBe($message)
                ->and($exception->getErrorMessage())->toBe($message)
                ->and($exception->getOk())->toBeFalsy()
                ->and($exception->getError())->toBe('missing_scope');
        });
});
