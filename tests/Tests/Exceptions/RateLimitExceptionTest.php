<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Exception\RateLimitException;

class RateLimitExceptionTest extends TestCase
{
    function testException()
    {
        $ex = new RateLimitException(10, 20, 'foobar');

        $this->assertEquals("foobar", $ex->getMessage());
        $this->assertEquals(10, $ex->getLimit());
        $this->assertEquals(20, $ex->getResetTimestamp());
    }
}
