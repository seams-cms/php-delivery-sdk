<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Model\WorkspaceCollection;
use SeamsCMS\Delivery\Model\WorkspaceCollectionEntry;

class WorkspaceCollectionTest extends TestCase
{

    function testCreate()
    {
        $data = array(
            'meta' => array(
            ),
            'entries' => array(
                [],
            ),
        );

        $collection = WorkspaceCollection::fromArray($data);

        $this->assertCount(1, $collection->getEntries());
        $this->assertInstanceOf(WorkspaceCollectionEntry::class, $collection->getEntries()[0]);
    }
}
