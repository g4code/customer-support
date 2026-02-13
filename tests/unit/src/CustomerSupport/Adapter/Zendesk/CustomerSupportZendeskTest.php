<?php

use G4\CustomerSupport\Adapter\Zendesk\Repository\CreateOrUpdateUsersRepository;
use G4\Gateway\Http;
use G4\CustomerSupport\Adapter\Zendesk\CustomerSupportZendesk;
use G4\CustomerSupport\Ticket;
use G4\Gateway\Options;
use G4\Gateway\Response;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class CustomerSupportZendeskTest extends TestCase
{
    private MockObject|Http $gateway;
    private MockObject|Response $response;
    private MockObject|Ticket $ticket;
    private MockObject|CreateOrUpdateUsersRepository $createOrUpdateUsersRepository;
    private CustomerSupportZendesk $customerSupportZendesk;

    protected function setUp(): void
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

    protected function tearDown(): void
    {
        unset($this->gateway, $this->ticket, $this->customerSupportZendesk, $this->response, $this->createOrUpdateUsersRepository);
    }

    public function testSendCustomerSupportTicketThrowException(): void
    {
        $this->expectException(\G4\CustomerSupport\Exceptions\FailedToSendCustomerSupportTicketException::class);
        $this->expectExceptionMessage('Failed to create ticket');
        
        $this->ticket
            ->expects($this->once())
            ->method('getEmail')
            ->willReturn(new Email('test@gmail.com'));

        $this->ticket
            ->expects($this->once())
            ->method('getName')
            ->willReturn(new StringLiteral('name'));

        $this->gateway
            ->expects($this->once())
            ->method('post')
            ->willReturn($this->response);

        $this->response
            ->expects($this->once())
            ->method('isSuccess')
            ->willReturn(false);

        $this->customerSupportZendesk->sendCustomerSupportTicket($this->ticket);
    }

    public function testGetTicket(): void
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
