<?php

use G4\CustomerSupport\Adapter\Zendesk\Map\SearchMap;
use G4\CustomerSupport\ParamsConst;
use G4\ValueObject\Email;
use PHPUnit\Framework\TestCase;

class SearchMapTest extends TestCase
{
    private array $data;

    protected function setUp(): void
    {
        $this->data = [
            ParamsConst::QUERY => 'test@email.com',
        ];
    }

    protected function tearDown(): void
    {
        unset($this->data);
    }

    public function testMap(): void
    {
        $searchMap = SearchMap::map(new Email('test@email.com'));

        $this->assertEquals($searchMap, $this->data);
    }
}
