<?php

use G4\CustomerSupport\Adapter\Zendesk\Map\CreateUpdateMap;
use G4\CustomerSupport\Adapter\Zendesk\User\User;
use G4\CustomerSupport\ParamsConst;
use G4\ValueObject\StringLiteral;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class CreateUpdateMapTest extends TestCase
{
    private MockObject|User $user;
    private array $data;

    protected function setUp(): void
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

    protected function tearDown(): void
    {
        unset($this->data, $this->user);
    }

    public function testMap(): void
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
