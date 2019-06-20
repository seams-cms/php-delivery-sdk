<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Model\ContentTypeField;

class DummyContentTypeField extends ContentTypeField {
}

class ContentTypeFieldTest extends TestCase
{

    function testEmpty()
    {
        $data = [];
        $field = DummyContentTypeField::fromArray($data);

        $this->assertEquals('', $field->getName());
        $this->assertFalse($field->isRequired());
    }

    function testCreate()
    {
        $data = [
            'name' => 'name',
            'description' => 'desc',
            'type' => 'type',
            'is_localized' => true,
            'is_required' => false,
        ];
        $field = DummyContentTypeField::fromArray($data);

        $this->assertEquals('name', $field->getName());
        $this->assertEquals('desc', $field->getDescription());
        $this->assertEquals('type', $field->getType());
        $this->assertTrue($field->isLocalized());
        $this->assertFalse($field->isRequired());
    }
}
