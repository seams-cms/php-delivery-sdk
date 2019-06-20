<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Model\Locale;

class LocaleTest extends TestCase
{

    function testLocale()
    {
        $data = array(
            'locale' => 'en-US',
            'name' => 'english',
        );

        $locale = Locale::fromArray($data);

        $this->assertEquals('english', $locale->getName());
        $this->assertEquals('en-US', $locale->getLocale());
    }

}
