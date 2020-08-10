<?php

namespace G4\CustomerSupport\Exceptions;

use G4\Constants\Http;

class AdapterNotImplementedException extends \Exception
{
    const MESSAGE = 'Adapter %s not implemented';

    /**
     * AdapterNotImplementedException constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $message = sprintf(self::MESSAGE, \var_export($value, true));
        parent::__construct($message, Http::CODE_404);
    }
}
