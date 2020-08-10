<?php

namespace G4\CustomerSupport\Adapter\Zendesk\Exceptions;

use G4\Constants\Http;

class FailedToCreateTicketException extends \Exception
{
    const MESSAGE = 'Failed to create ticket';

    /**
     * FailedToCreateTicketException constructor.
     */
    public function __construct()
    {
        parent::__construct(self::MESSAGE, Http::CODE_500);
    }
}
