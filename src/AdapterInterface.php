<?php

namespace G4\CustomerSupport;

interface AdapterInterface
{
    public function sendCustomerSupportTicket(Ticket $ticket);
}
