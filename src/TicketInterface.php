<?php

namespace G4\CustomerSupport;

interface TicketInterface
{
    public function getRequesterId();

    public function getSubject();

    public function getComment();
}
