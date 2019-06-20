<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Model\ContentTypeCollectionEntry;

class DummyContentTypeCollectionEntry extends ContentTypeCollectionEntry {
}

class ContentTypeCollectionEntryTest extends TestCase
{

    function testEmpty()
    {
        $data = [];
        $entry = DummyContentTypeCollectionEntry::fromArray($data);

        $this->assertEquals(0, $entry->getEntryCount());
    }

    function testCreate()
    {
        $data = [
            'id' => 'id',
            'name' => 'name',
            'description' => 'desc',
            'entry_count' => 123,
        ];
        $entry = DummyContentTypeCollectionEntry::fromArray($data);

        $this->assertEquals('id', $entry->getId());
        $this->assertEquals('name', $entry->getName());
        $this->assertEquals('desc', $entry->getDescription());
        $this->assertEquals(123, $entry->getEntryCount());
    }
}
