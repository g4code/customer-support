<?php

use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\CustomerSupport\Adapter\Zendesk\User\UserFactory;
use G4\CustomerSupport\ParamsConst;
use G4\CustomerSupport\Ticket;
use G4\ValueObject\Dictionary;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;

class TicketTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | Email
     */
    private $email;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | StringLiteral
     */
    private $name;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | StringLiteral
     */
    private $subject;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | StringLiteral
     */
    private $comment;

    /**
     * @var Ticket
     */
    private $ticket;

    public function setUp()
    {
        $this->email = $this->getMockBuilder(Email::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->name = $this->getMockBuilder(StringLiteral::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->subject = $this->getMockBuilder(StringLiteral::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->comment = $this->getMockBuilder(StringLiteral::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ticket = new Ticket($this->email, $this->name, $this->subject, $this->comment);
    }

    public function tearDown()
    {
        $this->email   = null;
        $this->name    = null;
        $this->subject = null;
        $this->comment = null;
    }

    public function testGetSetEmail()
    {
        $this->ticket->setEmail(new Email('test@email.com'));
        $this->assertEquals('test@email.com', $this->ticket->getEmail());
    }

    public function testGetSetName()
    {
        $this->ticket->setName(new StringLiteral('name'));
        $this->assertEquals('name', $this->ticket->getName());
    }

    public function testGetSetSubject()
    {
        $this->ticket->setSubject(new StringLiteral('subject'));
        $this->assertEquals('subject', $this->ticket->getSubject());
    }

    public function testGetSetComment()
    {
        $this->ticket->setComment(new StringLiteral('comment'));
        $this->assertEquals('comment', $this->ticket->getComment());
    }

    public function testGetSetUserId()
    {
        $this->ticket->setRequesterId(new StringLiteral('123456789'));
        $this->assertEquals('123456789', $this->ticket->getRequesterId());
    }
}
