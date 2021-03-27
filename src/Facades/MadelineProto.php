<?php

namespace GenVik\MadelineProto\Facades;

use danog\MadelineProto\API;
use GenVik\MadelineProto\TelegramObject;
use Illuminate\Support\Facades\Facade;

/**
 * Facade for MadelineProto class.
 *
 * @package GenVik\MadelineProto\Facades
 *
 * @method static TelegramObject phoneLogin(string $phone)
 * @method static TelegramObject completePhoneLogin(string $code)
 * @method static TelegramObject submit2FA(string $password)
 * @method static TelegramObject completeSignUp(string $firstName, string $lastName = '')
 * @method static API getClient()
 * @method static bool logout()
 * @method static bool isLoggedIn()
 *
 * @see \GenVik\MadelineProto\MadelineProto
 */
class MadelineProto extends Facade
{
    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor()
    {
        return 'madeline-proto';
    }
}
