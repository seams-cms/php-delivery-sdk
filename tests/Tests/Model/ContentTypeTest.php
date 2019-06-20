<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Exception\MissingFieldsException;
use SeamsCMS\Delivery\Model\ContentType;
use SeamsCMS\Delivery\Model\ContentTypeField;

class DummyContentType extends ContentType {
}

class ContentTypeTest extends TestCase
{

    function testEmpty()
    {
        $this->expectException(MissingFieldsException::class);

        $data = [];
        DummyContentType::fromArray($data);
    }

    function testCreate()
    {
        $data = [
            'name' => 'name',
            'description' => 'desc',
            'id' => 'id',
            'fields' => [
                ['name' => 'name'],
            ],
        ];
        $type = DummyContentType::fromArray($data);

        $this->assertEquals('name', $type->getName());
        $this->assertEquals('desc', $type->getDescription());
        $this->assertEquals('id', $type->getId());
        $this->assertCount(1, $type->getFields());
        $this->assertInstanceOf(ContentTypeField::class, $type->getFields()[0]);
    }
}
