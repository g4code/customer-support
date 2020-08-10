<?php

namespace G4\CustomerSupport\Adapter\Zendesk\Exceptions;

use G4\Constants\Http;

class FailedToCreateUserException extends \Exception
{
    const MESSAGE = 'Failed to create user';

    /**
     * FailedToCreateUserException constructor.
     */
    public function __construct()
    {
        parent::__construct(self::MESSAGE, Http::CODE_500);
    }
}
