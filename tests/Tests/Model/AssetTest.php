<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\Model\Asset;

class AssetTest extends TestCase
{

    /**
     * @dataProvider wrongDataProvider
     * @param $data
     */
    function testAssetWithWrongData($data)
    {
        $this->expectException(\InvalidArgumentException::class);
        Asset::fromArray($data);
    }

    public function wrongDataProvider()
    {
        return array(
            array(array()),
            array(array('meta' => array())),
            array(array('asset' => array())),
        );
    }

    function testAsset()
    {
        $data = array(
            'meta' => array(
                'foo' => 'bar',
                'created_at' => '01-02-1973',
                'updated_at' => '05-06-1977',
            ),
            'asset' => array(
                'link' => 'the-link',
                'thumbnailLink' => 'thumbnail-link',
                'size' => 123,
                'path' => 'the-path',
                'title' => 'the-title',
                'mimetype' => 'the-mimetype',
                'workspace' => 'the-workspace',
            ),
        );

        $asset = Asset::fromArray($data);

        $this->assertEquals('the-link', $asset->getLink());
        $this->assertEquals('thumbnail-link', $asset->getThumbnailLink());
        $this->assertEquals('123', $asset->getSize());
        $this->assertEquals('the-path', $asset->getPath());
        $this->assertEquals('the-title', $asset->getTitle());
        $this->assertEquals('the-mimetype', $asset->getMimetype());
        $this->assertEquals('the-workspace', $asset->getWorkspace());

        $this->assertEquals('01-02-1973', $asset->getMeta()->getCreatedAt()->format('d-m-Y'));
        $this->assertEquals('05-06-1977', $asset->getMeta()->getUpdatedAt()->format('d-m-Y'));
    }

}
