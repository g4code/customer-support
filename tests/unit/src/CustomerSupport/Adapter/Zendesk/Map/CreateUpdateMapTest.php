<?php

use G4\CustomerSupport\Adapter\Zendesk\Map\CreateUpdateMap;
use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\CustomerSupport\ParamsConst;
use G4\ValueObject\StringLiteral;

class CreateUpdateMapTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | User
     */
    private $user;
    private $data;

    public function setUp()
    {
        $this->user = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->data = [
            ParamsConst::USER => [
                ParamsConst::NAME  => 'name',
                ParamsConst::EMAIL => 'test@email.com'
            ]
        ];
    }

    public function tearDown()
    {
        $this->data = null;
        $this->user = null;
    }

    public function testMap()
    {
        $this->user
            ->expects($this->once())
            ->method('getName')
            ->willReturn(new StringLiteral('name'));

        $this->user
            ->expects($this->once())
            ->method('getEmail')
            ->willReturn(new StringLiteral('test@email.com'));

        $searchMap = CreateUpdateMap::map($this->user);

        $this->assertEquals($searchMap, $this->data);
    }
}
