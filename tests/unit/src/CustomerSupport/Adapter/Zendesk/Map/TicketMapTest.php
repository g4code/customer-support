<?php

use G4\CustomerSupport\Adapter\Zendesk\Map\TicketMap;
use G4\CustomerSupport\ParamsConst;
use G4\CustomerSupport\Ticket;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;

class TicketMapTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | Ticket
     */
    private $ticket;
    private $data;

    public function setUp()
    {
        $this->ticket = $this->getMockBuilder(Ticket::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->data = [
            ParamsConst::TICKET => [
                ParamsConst::REQUESTER_ID => '12345678',
                ParamsConst::SUBJECT      => 'subject',
                ParamsConst::COMMENT      => [
                    ParamsConst::BODY => 'comment'
                ]
            ]
        ];
    }

    public function tearDown()
    {
        $this->data   = null;
        $this->ticket = null;
    }

    public function testMap()
    {
        $this->ticket
            ->expects($this->once())
            ->method('getRequesterId')
            ->willReturn(new StringLiteral('12345678'));

        $this->ticket
            ->expects($this->once())
            ->method('getSubject')
            ->willReturn(new StringLiteral('subject'));

        $this->ticket
            ->expects($this->once())
            ->method('getComment')
            ->willReturn(new StringLiteral('comment'));

        $searchMap = TicketMap::map($this->ticket);

        $this->assertEquals($searchMap, $this->data);
    }
}
