<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Model\Locale;
use SeamsCMS\Delivery\Model\WorkspaceCollectionEntry;

class DummyWorkspaceCollectionEntry extends WorkspaceCollectionEntry {
}

class WorkspaceCollectionEntryTest extends TestCase
{

    function testEmpty()
    {
        $data = [];
        $entry = DummyWorkspaceCollectionEntry::fromArray($data);

        $this->assertCount(0, $entry->getLocales());
    }

    function testCreate()
    {
        $data = [
            'id' => 'id',
            'name' => 'name',
            'description' => 'desc',
            'is_archived' => true,
            'organisation' => 'initech',
            'locales' => [
                ['nl_NL' => 'Dutch'],
            ],
        ];
        $entry = DummyWorkspaceCollectionEntry::fromArray($data);

        $this->assertEquals('id', $entry->getId());
        $this->assertEquals('name', $entry->getName());
        $this->assertEquals('desc', $entry->getDescription());
        $this->assertTrue($entry->isArchived());
        $this->assertEquals('initech', $entry->getOrganisation());
        $this->assertCount(1, $entry->getLocales());
        $this->assertInstanceOf(Locale::class, $entry->getLocales()[0]);
    }
}
