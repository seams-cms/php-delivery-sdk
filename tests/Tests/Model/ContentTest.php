<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Exception\MissingFieldsException;
use SeamsCMS\Delivery\Model\Collection;
use SeamsCMS\Delivery\Model\CollectionMeta;
use SeamsCMS\Delivery\Model\Content;

class ContentTest extends TestCase
{

    function testSimpleContent()
    {
        $content = $this->createContent();

        // Meta check
        $this->assertEquals("1234", $content->getMeta()->getEntryId());

        // Default fields
        $this->assertEquals("my-title", $content->get('title'));
        $this->assertNull($content->get('does-not-exist'));


        // Localized fields
        $this->assertEquals("default-slug", $content->get('slug'));
        // known locale
        $this->assertEquals("slug-NL", $content->get('slug', 'nl_NL'));
        // unknown locale
        $this->assertEquals("default-slug", $content->get('slug', 'de_DE'));
        // unknown locale with fallback
        $this->assertEquals("slug-NL", $content->get('slug', 'de_DE', 'nl_NL'));
        // unknown locale with unknown fallback
        $this->assertEquals("default-slug", $content->get('slug', 'de_DE', 'fr_FR'));

        // Test isLocalized
        $this->assertFalse($content->isLocalized('title'));
        $this->assertTrue($content->isLocalized('slug'));
        $this->assertFalse($content->isLocalized('does-not-exist'));
    }

    function testRecursiveContent()
    {
        $content = $this->createContent();

        $content2 = $content->get('ref')[0];
        $this->assertEquals("43151", $content2->getMeta()->getEntryId());

        $this->assertEquals("john doe", $content2->get('author'));
        $this->assertFalse($content2->isLocalized('author'));
    }


    protected function createContent()
    {
        $data = [
            'meta' => [
                'revision_id' => "5678",
                'entry_id' => "1234",
                'content_type' => "foobar",
                'created_at' => "07-05-2019",
                'created_by' => "jane doe",
                'updated_at' => "01-02-2010",
                'updated_by' => "john doe",
            ],
            'content' => [
                'title' => [
                    'value' => 'my-title',
                    'locales' => [],
                ],
                'slug' => [
                    'value' => 'default-slug',
                    'locales' => [
                        'nl_NL' => 'slug-NL',
                        'en_US' => 'slug-EN',
                    ],
                ],
                'ref' => [
                    'value' => [
                        [
                            'meta' => [
                                'revision_id' => "97856",
                                'entry_id' => "43151",
                                'content_type' => "recursive-type",
                                'created_at' => "21-04-2011",
                                'created_by' => "jane doe",
                                'updated_at' => "06-09-2015",
                                'updated_by' => "john doe",
                            ],
                            'content' => [
                                'author' => [
                                    'value' => 'john doe',
                                    'locales' => [],
                                ],
                            ],
                        ],
                    ],
                    'locales' => [],
                ],
            ],
        ];

        return Content::fromArray($data);
    }

}
