<?php

use G4\CustomerSupport\Adapter\Zendesk\Repository\CreateTicketRepository;
use G4\CustomerSupport\Ticket;
use G4\Gateway\Http;
use G4\Gateway\Response;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class CreateTicketRepositoryTest extends TestCase
{
    private MockObject|Http $httpGateway;
    private MockObject|Response $response;
    private Ticket $ticket;

    protected function setUp(): void
    {
        $this->httpGateway = $this->getMockBuilder(Http::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->response = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ticket = new Ticket(
            new Email('test@email.com'),
            new StringLiteral('name'),
            new StringLiteral('subject'),
            new StringLiteral('comment')
        );
    }

    protected function tearDown(): void
    {
        unset($this->httpGateway, $this->response, $this->ticket);
    }

    public function testPostThrowException(): void
    {
        $this->expectException(\G4\CustomerSupport\Adapter\Zendesk\Exceptions\FailedToCreateTicketException::class);
        $this->expectExceptionMessage('Failed to create ticket');
        
        $this->httpGateway
            ->expects($this->once())
            ->method('post')
            ->willReturn($this->response);

        $this->response
            ->expects($this->once())
            ->method('isSuccess')
            ->willReturn(false);

        (new CreateTicketRepository($this->httpGateway))->post($this->ticket);
    }

    public function testPost(): void
    {
        $this->httpGateway
            ->expects($this->once())
            ->method('post')
            ->willReturn($this->response);

        $this->response
            ->expects($this->once())
            ->method('isSuccess')
            ->willReturn(true);

        (new CreateTicketRepository($this->httpGateway))->post($this->ticket);
    }
}
