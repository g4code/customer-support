<?php

namespace G4\CustomerSupport\Adapter\Zendesk\Repository;

use G4\Gateway\Http;
use G4\CustomerSupport\Adapter\Zendesk\Exceptions\FailedToCreateTicketException;
use G4\CustomerSupport\Adapter\Zendesk\Map\TicketMap;
use G4\CustomerSupport\Ticket;

class CreateTicketRepository
{
    const SERVICE_NAME = '/tickets';

    /**
     * @var Http
     */
    private $httpGateway;

    /**
     * CreateTicketRepository constructor.
     * @param Http $httpGateway
     */
    public function __construct(Http $httpGateway)
    {
        $httpGateway->setServiceName(self::SERVICE_NAME);
        $this->httpGateway = $httpGateway;
    }

    /**
     * @param Ticket $ticket
     * @throws FailedToCreateTicketException
     */
    public function post(Ticket $ticket)
    {
        $map = TicketMap::map($ticket);
        $response = $this->httpGateway->post($map);

        if (!$response->isSuccess()) {
            throw new FailedToCreateTicketException();
        }
    }
}
