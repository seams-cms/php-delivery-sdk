<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Exception\InvalidFieldsException;
use SeamsCMS\Delivery\Model\Collection;
use SeamsCMS\Delivery\Model\CollectionMeta;

class DummyCollection extends Collection {
}

class CollectionTest extends TestCase
{

    function testEmptyMetaData()
    {
        $this->expectException(InvalidFieldsException::class);

        $data = [];
        DummyCollection::fromArray($data);
    }

    function testCreate()
    {
        $data = [
            'meta' => [
                'limit' => 1,
                'offset' => 2,
                'total' => 3,
            ],
            'entries' => ['foo', 'bar'],
        ];
        $collection = DummyCollection::fromArray($data);

        $this->assertCount(2, $collection->getEntries());
        $this->assertInstanceOf(CollectionMeta::class, $collection->getMeta());
    }


}
