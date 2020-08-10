<?php

namespace G4\CustomerSupport\Adapter\Zendesk\User;

use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;

class User
{
    /**
     * @var Email
     */
    private $email;

    /**
     * @var StringLiteral
     */
    private $name;

    /**
     * @var StringLiteral
     */
    private $userId;

    /**
     * User constructor.
     * @param Email $email
     * @param StringLiteral $name
     */
    public function __construct(Email $email, StringLiteral $name)
    {
        $this->email  = $email;
        $this->name   = $name;
    }

    /**
     * @return Email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return StringLiteral
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return StringLiteral
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param StringLiteral $userId
     * @return $this
     */
    public function setUserId(StringLiteral $userId)
    {
        $this->userId = $userId;
        return $this;
    }
}
