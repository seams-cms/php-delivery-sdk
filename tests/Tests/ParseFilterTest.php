<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Filter;
use SeamsCMS\Delivery\ParseFilter;

class ParseFilterTest extends TestCase
{
    public function testParseWithNoFilter()
    {
        $qs = ParseFilter::generateQueryString(null);
        $this->assertEquals("", $qs);
    }

    public function testParseFilter()
    {
        $filter = new Filter();
        $filter->setOffset(123);
        $filter->setLimit(456);
        $filter->setSort("foobar");

        $qs = ParseFilter::generateQueryString($filter);
        $this->assertEquals("offset=123&limit=456&sort=foobar", $qs);
    }

    public function testSpecialChars()
    {
        $filter = new Filter();
        $filter->setOffset(123);
        $filter->setLimit(456);
        $filter->setSort("foo&b a r");

        $qs = ParseFilter::generateQueryString($filter);
        $this->assertEquals("offset=123&limit=456&sort=foo%26b%20a%20r", $qs);
    }

}
