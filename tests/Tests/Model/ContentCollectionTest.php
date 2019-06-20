<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Model\ContentCollection;
use SeamsCMS\Delivery\Model\Content;

class ContentCollectionTest extends TestCase
{

    function testCreate()
    {
        $data = array(
            'meta' => array(
            ),
            'entries' => array(
                ['meta' => [], 'content' => []],
            ),
        );

        $collection = ContentCollection::fromArray($data);

        $this->assertCount(1, $collection->getEntries());
        $this->assertInstanceOf(Content::class, $collection->getEntries()[0]);
    }
}
