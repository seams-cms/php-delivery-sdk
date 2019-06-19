<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Filter;

class FilterTest extends TestCase
{
    public function testFilterDefaults()
    {
        $filter = new Filter();
        $this->assertEquals(0, $filter->getOffset());
        $this->assertEquals(100, $filter->getLimit());
        $this->assertEquals("", $filter->getSort());
        $this->assertEquals("", $filter->getQuery());
    }

    public function testFilterGettersSetters()
    {
        $filter = new Filter();

        $filter->setOffset(123);
        $this->assertEquals(123, $filter->getOffset());

        $filter->setLimit(411);
        $this->assertEquals(411, $filter->getLimit());

        $filter->setSort("foobar");
        $this->assertEquals("foobar", $filter->getSort());

        $filter->setQuery("test");
        $this->assertEquals("test", $filter->getQuery());
    }
}
