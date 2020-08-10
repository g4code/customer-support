<?php

use G4\CustomerSupport\Adapter\Zendesk\Map\SearchMap;
use G4\CustomerSupport\ParamsConst;
use G4\ValueObject\Email;

class SearchMapTest extends PHPUnit_Framework_TestCase
{
    private $data;

    public function setUp()
    {
        $this->data = [
            ParamsConst::QUERY => 'test@email.com',
        ];
    }

    public function tearDown()
    {
        $this->data = null;
    }

    public function testMap()
    {
        $searchMap = SearchMap::map(new Email('test@email.com'));

        $this->assertEquals($searchMap, $this->data);
    }
}
