<?php

namespace G4\CustomerSupport\Adapter\Zendesk\Map;

use G4\CustomerSupport\ParamsConst;
use G4\CustomerSupport\Ticket;

class TicketMap
{
    public static function map(Ticket $ticket)
    {
        return [
            ParamsConst::TICKET => [
                ParamsConst::REQUESTER_ID => (string)$ticket->getRequesterId(),
                ParamsConst::SUBJECT      => (string)$ticket->getSubject(),
                ParamsConst::COMMENT      => [
                    ParamsConst::BODY => (string)$ticket->getComment()
                ]
            ]
        ];
    }
}
