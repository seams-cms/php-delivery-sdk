<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Model\CollectionMeta;

class DummyCollectionMeta extends CollectionMeta {
}

class CollectionMetaTest extends TestCase
{

    function testEmptyMetaData()
    {
        $data = [];
        $meta = DummyCollectionMeta::fromArray($data);

        $this->assertEquals(0, $meta->getLimit());
        $this->assertEquals(0, $meta->getOffset());
        $this->assertEquals(0, $meta->getTotal());
    }

    function testMetaData()
    {
        $data = [
            'limit' => 1,
            'offset' => 2,
            'total' => 3,
        ];
        $meta = DummyCollectionMeta::fromArray($data);

        $this->assertEquals(1, $meta->getLimit());
        $this->assertEquals(2, $meta->getOffset());
        $this->assertEquals(3, $meta->getTotal());
    }

}
