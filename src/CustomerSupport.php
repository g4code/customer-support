<?php

namespace G4\CustomerSupport;

use G4\CustomerSupport\Exceptions\FailedToSendCustomerSupportTicketException;

abstract class CustomerSupport implements AdapterInterface
{
    /**
     * @param Ticket $ticket
     * @return mixed
     * @throws FailedToSendCustomerSupportTicketException
     */
    abstract public function sendCustomerSupportTicket(Ticket $ticket);
}
