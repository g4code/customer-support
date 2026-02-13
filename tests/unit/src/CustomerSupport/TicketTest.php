<?php

use G4\CustomerSupport\Ticket;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class TicketTest extends TestCase
{
    private MockObject|Email $email;
    private MockObject|StringLiteral $name;
    private MockObject|StringLiteral $subject;
    private MockObject|StringLiteral $comment;
    private Ticket $ticket;

    protected function setUp(): void
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

    protected function tearDown(): void
    {
        unset($this->email, $this->name, $this->subject, $this->comment, $this->ticket);
    }

    public function testGetSetEmail(): void
    {
        $this->ticket->setEmail(new Email('test@email.com'));
        $this->assertEquals('test@email.com', $this->ticket->getEmail());
    }

    public function testGetSetName(): void
    {
        $this->ticket->setName(new StringLiteral('name'));
        $this->assertEquals('name', $this->ticket->getName());
    }

    public function testGetSetSubject(): void
    {
        $this->ticket->setSubject(new StringLiteral('subject'));
        $this->assertEquals('subject', $this->ticket->getSubject());
    }

    public function testGetSetComment(): void
    {
        $this->ticket->setComment(new StringLiteral('comment'));
        $this->assertEquals('comment', $this->ticket->getComment());
    }

    public function testGetSetUserId(): void
    {
        $this->ticket->setRequesterId(new StringLiteral('123456789'));
        $this->assertEquals('123456789', $this->ticket->getRequesterId());
    }
}
