<?php

use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\CustomerSupport\Adapter\Zendesk\User\UserFactory;
use G4\CustomerSupport\ParamsConst;
use G4\ValueObject\Dictionary;

class UserFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $factory;
    private $data;

    public function setUp()
    {
        $this->data = new Dictionary([
            ParamsConst::EMAIL => 'test@email.com',
            ParamsConst::NAME  => 'name',
        ]);

        $this->factory = new UserFactory();
    }

    public function tearDown()
    {
        $this->data = null;
    }

    public function testReconstituteWithBasicData()
    {
        $user =  $this->factory
            ->set($this->data)
            ->reconstitute();

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('test@email.com', $user->getEmail());
    }

    public function testReconstituteWithUserId()
    {
        $data = new Dictionary([
            ParamsConst::EMAIL => 'test@email.com',
            ParamsConst::NAME  => 'name',
            ParamsConst::ID  => '123456789',
        ]);

        $user = $this->factory
            ->set($data)
            ->reconstitute();

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('123456789', $user->getUserId());
    }
}
