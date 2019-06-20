<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Model\AssetCollection;
use SeamsCMS\Delivery\Model\Asset;

class AssetCollectionTest extends TestCase
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

        $collection = AssetCollection::fromArray($data);

        $this->assertCount(1, $collection->getEntries());
        $this->assertInstanceOf(Asset::class, $collection->getEntries()[0]);
    }
}
