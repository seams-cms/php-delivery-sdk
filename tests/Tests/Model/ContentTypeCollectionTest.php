<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Model\ContentTypeCollection;
use SeamsCMS\Delivery\Model\ContentTypeCollectionEntry;

class ContentTypeCollectionTest extends TestCase
{

    function testCreate()
    {
        $data = array(
            'meta' => array(
            ),
            'entries' => array(
                ['meta' => [], 'asset' => []],
            ),
        );

        $collection = ContentTypeCollection::fromArray($data);

        $this->assertCount(1, $collection->getEntries());
        $this->assertInstanceOf(ContentTypeCollectionEntry::class, $collection->getEntries()[0]);
    }
}
