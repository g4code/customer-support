<?php

use G4\CustomerSupport\Adapter\Zendesk\Repository\CreateOrUpdateUsersRepository;
use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\CustomerSupport\ParamsConst;
use G4\Gateway\Http;
use G4\CustomerSupport\Adapter\Zendesk\CustomerSupportZendesk;
use G4\CustomerSupport\Ticket;
use G4\Gateway\Options;
use G4\Gateway\Response;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;

class CustomerSupportZendeskTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | Http
     */
    private $gateway;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | Response
     */
    private $response;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | Ticket
     */
    private $ticket;

    /**
     * @var CustomerSupportZendesk
     */
    private $customerSupportZendesk;

    public function setUp()
    {
        $this->gateway = $this->getMockBuilder(Http::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->response = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ticket = $this->getMockBuilder(Ticket::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->createOrUpdateUsersRepository = $this->getMockBuilder(CreateOrUpdateUsersRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerSupportZendesk = new CustomerSupportZendesk($this->gateway, $this->ticket);
    }

    public function tearDown()
    {
        $this->gateway                = null;
        $this->ticket                 = null;
        $this->customerSupportZendesk = null;
    }

//    public function SendCustomerSupportTicket()
//    {
//        $ticket = new Ticket(
//            new Email('test@gmail.com'),
//            new StringLiteral('name'),
//            new StringLiteral('subject'),
//            new StringLiteral('comment')
//        );
//        $ticket->setRequesterId(new StringLiteral('1235567'));
//
//        $gateway = new Http('url', new Options('test'));
//        (new CustomerSupportZendesk($gateway, $ticket))->sendCustomerSupportTicket($ticket);
//    }

    /**
     *@expectedException  G4\CustomerSupport\Exceptions\FailedToSendCustomerSupportTicketException
     * @expectedExceptionMessage Failed to create ticket
     */
    public function testSendCustomerSupportTicketThrowException()
    {
        $this->ticket
            ->expects($this->once())
            ->method('getEmail')
            ->willReturn(new StringLiteral('test@gmail.com'));

        $this->ticket
            ->expects($this->once())
            ->method('getName')
            ->willReturn(null);

        $this->customerSupportZendesk->sendCustomerSupportTicket($this->ticket);
    }

    public function testGetTicket()
    {
        $ticket = new Ticket(
            new Email('test@gmail.com'),
            new StringLiteral('name'),
            new StringLiteral('subject'),
            new StringLiteral('comment')
        );
        $gateway = new Http('url', new Options('test'));
        $results = (new CustomerSupportZendesk($gateway, $ticket))->getTicket();
        $this->assertEquals($ticket, $results);
    }
}
