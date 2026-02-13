<?php

use G4\CustomerSupport\Adapter\Zendesk\Map\TicketMap;
use G4\CustomerSupport\ParamsConst;
use G4\CustomerSupport\Ticket;
use G4\ValueObject\StringLiteral;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class TicketMapTest extends TestCase
{
    private MockObject|Ticket $ticket;
    private array $data;

    protected function setUp(): void
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

    protected function tearDown(): void
    {
        unset($this->data, $this->ticket);
    }

    public function testMap(): void
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
