<?php

namespace G4\CustomerSupport\Adapter\Zendesk\Exceptions;

use G4\Constants\Http;

class FailedToFindEmailException extends \Exception
{
    const MESSAGE = 'Failed to find user with email: %s';

    /**
     * FailedToFindEmailException constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $message = sprintf(self::MESSAGE, \var_export($value, true));
        parent::__construct($message, Http::CODE_404);
    }
}
