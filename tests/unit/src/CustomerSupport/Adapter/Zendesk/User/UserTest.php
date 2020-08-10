<?php

use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\ValueObject\Email;
use G4\ValueObject\StringLiteral;

class UserTest extends \PHPUnit_Framework_TestCase
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
     * @var PHPUnit_Framework_MockObject_MockObject | User
     */
    private $user;

    public function setUp()
    {
        $this->email = new Email('test@email.com');

        $this->name =new StringLiteral('name');

        $this->user = new User($this->email, $this->name);
    }

    public function tearDown()
    {
        $this->email = null;
        $this->name  = null;
        $this->user  = null;
    }

    public function testGetEmail()
    {
        $this->assertEquals($this->email, $this->user->getEmail());
    }

    public function testGetName()
    {
        $this->assertEquals($this->name, $this->user->getName());
    }

    public function testSetGetUserId()
    {
        $this->user->setUserId(new StringLiteral('12345678'));
        $this->assertEquals(new StringLiteral('12345678'), $this->user->getUserId());
    }
}
