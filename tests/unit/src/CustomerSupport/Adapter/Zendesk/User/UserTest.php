<?php

use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private Email $email;
    private StringLiteral $name;
    private User $user;

    protected function setUp(): void
    {
        $this->email = new Email('test@email.com');

        $this->name = new StringLiteral('name');

        $this->user = new User($this->email, $this->name);
    }

    protected function tearDown(): void
    {
        unset($this->email, $this->name, $this->user);
    }

    public function testGetEmail(): void
    {
        $this->assertEquals($this->email, $this->user->getEmail());
    }

    public function testGetName(): void
    {
        $this->assertEquals($this->name, $this->user->getName());
    }

    public function testSetGetUserId(): void
    {
        $this->user->setUserId(new StringLiteral('12345678'));
        $this->assertEquals(new StringLiteral('12345678'), $this->user->getUserId());
    }
}
