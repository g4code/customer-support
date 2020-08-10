<?php

namespace G4\CustomerSupport;

use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;

class Ticket implements TicketInterface
{
    /**
     * @var Email
     */
    private $email;

    /**
     * @var StringLiteral
     */
    private $requesterId;

    /**
     * @var StringLiteral
     */
    private $name;

    /**
     * @var StringLiteral
     */
    private $subject;

    /**
     * @var StringLiteral
     */
    private $comment;

    /**
     * Ticket constructor.
     * @param Email $email
     * @param StringLiteral $name
     * @param StringLiteral $subject
     * @param StringLiteral $comment
     */
    public function __construct(Email $email, StringLiteral $name, StringLiteral $subject, StringLiteral $comment)
    {
        $this->email       = $email;
        $this->name        = $name;
        $this->subject     = $subject;
        $this->comment     = $comment;
    }

    /**
     * @return Email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param Email $email
     * @return $this
     */
    public function setEmail(Email $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return StringLiteral
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param StringLiteral $name
     * @return $this
     */
    public function setName(StringLiteral $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return StringLiteral
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param StringLiteral $subject
     * @return $this
     */
    public function setSubject(StringLiteral $subject)
    {
        $this->subject = $subject;
        return $this;
    }


    /**
     * @return StringLiteral
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param StringLiteral $comment
     * @return $this
     */
    public function setComment(StringLiteral $comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @return StringLiteral
     */
    public function getRequesterId()
    {
        return $this->requesterId;
    }

    /**
     * @param StringLiteral $requesterId
     * @return $this
     */
    public function setRequesterId(StringLiteral $requesterId)
    {
        $this->requesterId = $requesterId;
        return $this;
    }
}
