<?php

declare(strict_types=1);

namespace Slack\Transporters;

use Closure;
use Exception;
use JsonException;
use Psr\Http\Client\ClientInterface;
use Slack\Exceptions\ErrorException;
use Psr\Http\Message\ResponseInterface;
use Slack\Contracts\TransporterContract;
use GuzzleHttp\Exception\ClientException;
use Slack\Exceptions\TransporterException;
use Slack\ValueObjects\Transporter\BaseUri;
use Slack\ValueObjects\Transporter\Headers;
use Slack\ValueObjects\Transporter\Payload;
use Slack\Exceptions\UnserializableResponse;
use Psr\Http\Client\ClientExceptionInterface;
use Slack\ValueObjects\Transporter\QueryParams;

/**
 * @internal
 */
final class HttpTransporter implements TransporterContract
{
    /**
     * Creates a new Http Transporter instance.
     */
    public function __construct(
        private readonly ClientInterface $client,
        private readonly BaseUri $baseUri,
        private readonly Headers $headers,
        private readonly QueryParams $queryParams,
    ) {
        // ..
    }

    /**
     * {@inheritDoc}
     */
    public function requestObject(Payload $payload): array|string
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);

        $response = $this->sendRequest(fn (): \Psr\Http\Message\ResponseInterface => $this->client->sendRequest($request));

        $contents = $response->getBody()->getContents();

        if ($response->getHeader('Content-Type')[0] === 'text/plain; charset=utf-8') {
            return $contents;
        }

        $this->throwIfError($response, $contents);

        try {
            /** @var array{error?: array{message: string, type: string, code: string}} $response */
            $response = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }

        return $response;
    }

    /**
     * {@inheritDoc}
     */
    public function requestContent(Payload $payload): string
    {
        $request = $payload->toRequest($this->baseUri, $this->headers, $this->queryParams);

        $response = $this->sendRequest(fn (): \Psr\Http\Message\ResponseInterface => $this->client->sendRequest($request));

        $contents = $response->getBody()->getContents();

        $this->throwIfError($response, $contents);

        return $contents;
    }

    private function sendRequest(Closure $callable): ResponseInterface
    {
        try {
            return $callable();
        } catch (ClientExceptionInterface $clientException) {
            if ($clientException instanceof ClientException) {
                $this->throwIfError($clientException->getResponse(), $clientException->getResponse()->getBody()->getContents());
            }

            throw new TransporterException($clientException);
        }
    }

    private function throwIfError(ResponseInterface $response, string|ResponseInterface $contents): void
    {
        if ($contents instanceof ResponseInterface) {
            $contents = $contents->getBody()->getContents();
        }

        try {
            /** @var array{ok: bool, error?: string} $response */
            $response = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
            if (! $response['ok'] && isset($response['error'])) {
                $exception = $this->throwException($response['error']);

                throw new $exception($response);
            }
        } catch (JsonException $jsonException) {
            throw new UnserializableResponse($jsonException);
        }
    }

    /**
     * Return the class to throw based on the error.
     *
     *
     * @return class-string<Exception>
     */
    private function throwException(string $error)
    {
        return match ($error) {
            /** Reminder exceptions **/
            'cannot_add_bot' => \Slack\Exceptions\Slack\CannotAddBotException::class,
            'cannot_add_others' => \Slack\Exceptions\Slack\CannotAddOthersException::class,
            'cannot_add_others_recurring' => \Slack\Exceptions\Slack\CannotAddOthersRecurringException::class,
            'cannot_add_profile_only_user' => \Slack\Exceptions\Slack\CannotAddProfileOnlyUserException::class,
            'cannot_add_slackbot' => \Slack\Exceptions\Slack\CannotAddSlackbotException::class,
            'cannot_parse' => \Slack\Exceptions\Slack\CannotParseException::class,
            'cannot_complete_others' => \Slack\Exceptions\Slack\CannotCompleteOthersException::class,
            'cannot_complete_recurring' => \Slack\Exceptions\Slack\CannotCompleteRecurringException::class,
            /** Conversation exceptions **/
            'cant_invite_self' => \Slack\Exceptions\Slack\CantInviteSelfException::class,
            'channel_not_found' => \Slack\Exceptions\Slack\ChannelNotFoundException::class,
            'method_not_supported_for_channel_type' => \Slack\Exceptions\Slack\MethodNotSupportedForChannelTypeException::class,
            'cant_kick_from_general' => \Slack\Exceptions\Slack\CantKickFromGeneralException::class,
            'cant_kick_self' => \Slack\Exceptions\Slack\CantKickSelfException::class,
            'not_in_channel' => \Slack\Exceptions\Slack\NotInChannelException::class,
            'fetch_members_failed' => \Slack\Exceptions\Slack\FetchMembersFailedException::class,
            'name_taken' => \Slack\Exceptions\Slack\NameTakenException::class,
            'no_channel' => \Slack\Exceptions\Slack\NoChannelException::class,
            'restricted_action' => \Slack\Exceptions\Slack\RestrictedActionException::class,
            'invalid_name_maxlength' => \Slack\Exceptions\Slack\InvalidNameMaxLengthException::class,
            'invalid_name_punctuation' => \Slack\Exceptions\Slack\InvalidNamePunctuationException::class,
            'invalid_name_required' => \Slack\Exceptions\Slack\InvalidNameRequiredException::class,
            'invalid_name_specials' => \Slack\Exceptions\Slack\InvalidNameSpecialsException::class,
            'cannot_create_channel' => \Slack\Exceptions\Slack\CannotCreateChannelException::class,
            'is_archived' => \Slack\Exceptions\Slack\IsArchivedException::class,
            'too_many_members' => \Slack\Exceptions\Slack\TooManyMembersException::class,
            'already_archived' => \Slack\Exceptions\Slack\AlreadyArchivedException::class,
            'cant_archive_general' => \Slack\Exceptions\Slack\CantArchiveGeneralException::class,
            'cant_archive_required' => \Slack\Exceptions\Slack\CantArchiveRequiredException::class,
            'not_archived' => \Slack\Exceptions\Slack\NotArchivedException::class,
            /** User exceptions **/
            'too_many_users' => \Slack\Exceptions\Slack\TooManyUsersException::class,
            'user_not_found' => \Slack\Exceptions\Slack\UserNotFoundException::class,
            'user_not_visible' => \Slack\Exceptions\Slack\UserNotVisibleException::class,
            /** Reactions execptions **/
            'already_reacted' => \Slack\Exceptions\Slack\AlreadyReactedException::class,
            'external_channel_migrating' => \Slack\Exceptions\Slack\ExternalChannelMigratingException::class,
            'message_not_found' => \Slack\Exceptions\Slack\MessageNotFoundException::class,
            'no_item_specified' => \Slack\Exceptions\Slack\NoItemSpecifiedException::class,
            'not_reactable' => \Slack\Exceptions\Slack\NotReactableException::class,
            'thread_locked' => \Slack\Exceptions\Slack\ThreadLockedException::class,
            'too_many_emoji' => \Slack\Exceptions\Slack\TooManyEmojiException::class,
            'too_many_reactions' => \Slack\Exceptions\Slack\TooManyReactionsException::class,
            'file_not_found' => \Slack\Exceptions\Slack\FileNotFoundException::class,
            'file_comment_not_found' => \Slack\Exceptions\Slack\FileCommentNotFoundException::class,
            'no_reaction' => \Slack\Exceptions\Slack\NoReactionException::class,
            /** Common exceptions **/
            'invalid_name' => \Slack\Exceptions\Slack\InvalidNameException::class,
            'bad_timestamp' => \Slack\Exceptions\Slack\BadTimestampException::class,
            'not_found' => \Slack\Exceptions\Slack\NotFoundException::class,
            'missing_argument' => \Slack\Exceptions\Slack\MissingArgumentException::class,
            'invalid_cursor' => \Slack\Exceptions\Slack\InvalidCursorException::class,
            'invalid_limit' => \Slack\Exceptions\Slack\InvalidLimitException::class,
            'invalid_types' => \Slack\Exceptions\Slack\InvalidTypesException::class,
            'team_access_not_granted' => \Slack\Exceptions\Slack\TeamAccessNotGrantedException::class,
            'access_denied' => \Slack\Exceptions\Slack\AccessDeniedException::class,
            'account_inactive' => \Slack\Exceptions\Slack\AccountInactiveException::class,
            'deprecated_endpoint' => \Slack\Exceptions\Slack\DeprecatedEndpointException::class,
            'ekm_access_denied' => \Slack\Exceptions\Slack\EkmAccessDeniedException::class,
            'enterprise_is_restricted' => \Slack\Exceptions\Slack\EnterpriseIsRestrictedException::class,
            'invalid_auth' => \Slack\Exceptions\Slack\InvalidAuthException::class,
            'method_deprecated' => \Slack\Exceptions\Slack\MethodDeprecatedException::class,
            'missing_scope' => \Slack\Exceptions\Slack\MissingScopeException::class,
            'not_allowed_token_type' => \Slack\Exceptions\Slack\NotAllowedTokenTypeException::class,
            'not_authed' => \Slack\Exceptions\Slack\NotAuthedException::class,
            'no_permission' => \Slack\Exceptions\Slack\NoPermissionException::class,
            'org_login_required' => \Slack\Exceptions\Slack\OrgLoginRequiredException::class,
            'token_expired' => \Slack\Exceptions\Slack\TokenExpiredException::class,
            'token_revoked' => \Slack\Exceptions\Slack\TokenRevokedException::class,
            'two_factor_setup_required' => \Slack\Exceptions\Slack\TwoFactorSetupRequiredException::class,
            'accesslimited' => \Slack\Exceptions\Slack\AccessLimitedException::class,
            'too_many_requests' => \Slack\Exceptions\Slack\TooManyRequestsException::class,
            'fatal_error' => \Slack\Exceptions\Slack\FatalErrorException::class,
            'internal_error' => \Slack\Exceptions\Slack\InternalErrorException::class,
            'invalid_arg_name' => \Slack\Exceptions\Slack\InvalidArgNameException::class,
            'invalid_arguments' => \Slack\Exceptions\Slack\InvalidArgumentsException::class,
            'invalid_array_arg' => \Slack\Exceptions\Slack\InvalidArrayArgException::class,
            'invalid_charset' => \Slack\Exceptions\Slack\InvalidCharsetException::class,
            'invalid_form_data' => \Slack\Exceptions\Slack\InvalidFormDataException::class,
            'invalid_post_type' => \Slack\Exceptions\Slack\InvalidPostTypeException::class,
            'missing_post_type' => \Slack\Exceptions\Slack\MissingPostTypeException::class,
            'ratelimited' => \Slack\Exceptions\Slack\RateLimitedException::class,
            'request_timeout' => \Slack\Exceptions\Slack\RequestTimeoutException::class,
            'service_unavailable' => \Slack\Exceptions\Slack\ServiceUnavailableException::class,
            'team_added_to_org' => \Slack\Exceptions\Slack\TeamAddedToOrgException::class,
            default => ErrorException::class,
        };
    }
}
