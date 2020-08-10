<?php

namespace G4\CustomerSupport\Adapter\Zendesk;

use G4\Gateway\Http;
use G4\CustomerSupport\Adapter\Zendesk\Repository\CreateTicketRepository;
use G4\CustomerSupport\Adapter\Zendesk\Repository\CreateOrUpdateUsersRepository;
use G4\CustomerSupport\Adapter\Zendesk\Repository\SearchUsersRepository;
use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\CustomerSupport\CustomerSupport;
use G4\CustomerSupport\Exceptions\FailedToSendCustomerSupportTicketException;
use G4\CustomerSupport\Ticket;

class CustomerSupportZendesk extends CustomerSupport
{
    /**
     * @var Http
     */
    private $gateway;

    /**
     * @var Ticket
     */
    private $ticket;

    /**
     * CustomerSupportZendesk constructor.
     * @param Http $gateway
     * @param Ticket $ticket
     */
    public function __construct(Http $gateway, Ticket $ticket)
    {
        $this->gateway = $gateway;
        $this->ticket = $ticket;
    }

    /**
     * @param Ticket $ticket
     * @return mixed|void
     * @throws FailedToSendCustomerSupportTicketException
     */
    public function sendCustomerSupportTicket(Ticket $ticket)
    {
        try {
            (new CreateOrUpdateUsersRepository($this->gateway))
                ->post(new User($ticket->getEmail(), $ticket->getName()));

            $user = (new SearchUsersRepository($this->gateway))->findUserByEmail($ticket->getEmail());
            $ticket->setRequesterId($user->getUserId());

            (new CreateTicketRepository($this->gateway))->post($ticket);
        } catch (\Exception $e) {
            throw new FailedToSendCustomerSupportTicketException();
        }
    }

    /**
     * @return Ticket
     */
    public function getTicket()
    {
        return $this->ticket;
    }
}
