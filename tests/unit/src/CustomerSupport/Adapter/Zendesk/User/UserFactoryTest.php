<?php

use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\CustomerSupport\Adapter\Zendesk\User\UserFactory;
use G4\CustomerSupport\ParamsConst;
use G4\ValueObject\Dictionary;
use PHPUnit\Framework\TestCase;

class UserFactoryTest extends TestCase
{
    private UserFactory $factory;
    private Dictionary $data;

    protected function setUp(): void
    {
        $this->data = new Dictionary([
            ParamsConst::EMAIL => 'test@email.com',
            ParamsConst::NAME  => 'name',
        ]);

        $this->factory = new UserFactory();
    }

    protected function tearDown(): void
    {
        unset($this->data, $this->factory);
    }

    public function testReconstituteWithBasicData(): void
    {
        $user =  $this->factory
            ->set($this->data)
            ->reconstitute();

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('test@email.com', $user->getEmail());
    }

    public function testReconstituteWithUserId(): void
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
