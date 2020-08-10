<?php

use G4\CustomerSupport\Adapter\Zendesk\Repository\CreateTicketRepository;
use G4\CustomerSupport\Ticket;
use G4\Gateway\Http;
use G4\Gateway\Response;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;

class CreateTicketRepositoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | Http
     */
    private $httpGateway;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | Response
     */
    private $response;

    /**
     * @var Ticket
     */
    private $ticket;

    public function setUp()
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

    public function tearDown()
    {
        $this->httpGateway = null;
        $this->response    = null;
        $this->ticket      = null;
    }

    /**
     * @expectedException G4\CustomerSupport\Adapter\Zendesk\Exceptions\FailedToCreateTicketException
     * @expectedExceptionMessage Failed to create ticket
     */
    public function testPostThrowException()
    {
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

    public function testPost()
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
