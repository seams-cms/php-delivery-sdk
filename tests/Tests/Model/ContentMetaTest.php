<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Model\ContentMeta;

class DummyContentMeta extends ContentMeta {
}

class ContentMetaTest extends TestCase
{

    function testEmptyMetaData()
    {
        $data = [];
        $meta = DummyContentMeta::fromArray($data);

        $this->assertEquals("", $meta->getRevisionId());
    }

    function testMetaData()
    {
        $data = [
            'revision_id' => "5678",
            'entry_id' => "1234",
            'content_type' => "foobar",
            'created_at' => "07-05-2019",
            'created_by' => "jane doe",
            'updated_at' => "01-02-2010",
            'updated_by' => "john doe",
        ];
        $meta = DummyContentMeta::fromArray($data);

        $this->assertEquals("5678", $meta->getRevisionId());
        $this->assertEquals("1234", $meta->getEntryId());
        $this->assertEquals("foobar", $meta->getContentType());
        $this->assertEquals("07-05-2019", $meta->getCreatedAt()->format('d-m-Y'));
        $this->assertEquals("jane doe", $meta->getCreatedBy());
        $this->assertEquals("01-02-2010", $meta->getUpdatedAt()->format('d-m-Y'));
        $this->assertEquals("john doe", $meta->getUpdatedBy());
    }

}
