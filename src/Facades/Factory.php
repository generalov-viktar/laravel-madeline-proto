<?php

namespace GenVik\MadelineProto\Facades;

use Illuminate\Support\Facades\Facade;
use \GenVik\MadelineProto\MadelineProto;

/**
 * Facade for MadelineProtoFactory class.
 *
 * @package GenVik\MadelineProto\Facades
 *
 * @method static MadelineProto get(mixed $session, array $config = null)
 * @method static MadelineProto make(string $sessionFile, array $config)
 */
class Factory extends Facade
{
    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor()
    {
        return 'madeline-proto-factory';
    }
}
