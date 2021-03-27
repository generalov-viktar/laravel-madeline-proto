<?php

namespace GenVik\MadelineProto;

use danog\MadelineProto\API as Client;
use GenVik\MadelineProto\Constants\Account;
use GenVik\MadelineProto\Exceptions\NeedTwoFactorAuthException;
use GenVik\MadelineProto\Exceptions\SignUpNeededException;

class MadelineProto
{
    /**
     * @var Client
     */
    private $client;

    /**
     * MadelineProto constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Sending the phone code.
     *
     * @param string $phone
     * @return TelegramObject
     */
    public function phoneLogin(string $phone): TelegramObject
    {
        return new TelegramObject($this->client->phoneLogin($phone));
    }

    /**
     * Do a sign in attempt by submitting phone code sent to the user.
     *
     * @param string $code
     * @return TelegramObject auth.Authorization
     * @throws NeedTwoFactorAuthException|SignUpNeededException
     */
    public function completePhoneLogin(string $code): TelegramObject
    {
        $response = new TelegramObject($this->client->completePhoneLogin($code));

        switch ($response->return_type) {
            case Account::PASSWORD:
                throw new NeedTwoFactorAuthException($response);
            case Account::NEED_SIGN_UP:
                throw new SignUpNeededException();
        }

        return $response;
    }

    /**
     * Submit 2FA password.
     *
     * @param string $password
     * @return TelegramObject
     */
    public function submit2FA(string $password): TelegramObject
    {
        return new TelegramObject($this->client->complete2faLogin($password));
    }

    /**
     * Complete Sign up to Telegram.
     *
     * @param string $firstName
     * @param string $lastName
     */
    public function completeSignUp(string $firstName, string $lastName = ''): void
    {
        $this->client->completeSignup($firstName, $lastName);
    }

    /**
     * Get info about the logged-in user, cached.
     *
     * @param array $extra
     * @return bool|TelegramObject
     */
    public function getSelf(array $extra = [])
    {
        $self = $this->client->getSelf($extra);

        return $self !== false ?
            new TelegramObject($self)
            :
            false;
    }

    /**
     * Get info about the logged-in user, not cached.
     *
     * @param array $extra
     * @return bool|TelegramObject
     */
    public function fullGetSelf(array $extra = [])
    {
        $self = $this->client->fullGetSelf($extra);

        return $self !== false ?
            new TelegramObject($self)
            :
            false;
    }

    /**
     * Logout the Telegram account.
     *
     * @return bool
     */
    public function logout(): bool
    {
        return $this->client->logout() === true;
    }

    /**
     * Get MadelineProto\API instance.
     *
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * Determine if the current client is logged in.
     *
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        return $this->fullGetSelf() !== false;
    }

    /**
     * Get MadelineProto Message API wrapper instance.
     *
     * @return ClientMessages
     */
    public function messages()
    {
        return new ClientMessages($this->client->messages);
    }
}
