<?php

namespace G4\CustomerSupport\Exceptions;

use G4\Constants\Http;

class FailedToSendCustomerSupportTicketException extends \Exception
{
    const MESSAGE = 'Failed to create ticket';

    /**
     * FailedToSendCustomerSupportTicketException constructor.
     */
    public function __construct()
    {
        parent::__construct(self::MESSAGE, Http::CODE_500);
    }
}
