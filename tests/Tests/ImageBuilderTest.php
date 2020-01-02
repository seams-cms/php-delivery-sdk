<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\ImageBuilder;
use SeamsCMS\Delivery\Model\Asset;

class ImageBuilderTest extends TestCase
{
    public function testSimpleImage()
    {
        $asset = Asset::fromArray(['asset' => ['workspace' => 'workspace', 'path' => 'image.jpg'], 'meta' => []]);

        $src = ImageBuilder::fromAsset($asset)->getSourceUrl();
        $this->assertEquals('https://assets.seams-cms.com/workspace/image.jpg', $src);


        $src = ImageBuilder::fromPath('foo', 'bar')->getSourceUrl();
        $this->assertEquals('https://assets.seams-cms.com/foo/bar', $src);
    }

    public function testComplexImage()
    {
        $asset = Asset::fromArray(['asset' => ['workspace' => 'workspace', 'path' => 'image.jpg'], 'meta' => []]);

        $src = ImageBuilder::fromAsset($asset)
            ->skipCdn()
            ->colorize(255, 0, 0, 100)
            ->blur()
            ->negate()
            ->gray()
            ->rotate(35)
            ->height(500)
            ->blur()
            ->getSourceUrl()
        ;
        $this->assertEquals('https://assets-nocdn.seams-cms.com/p/blur/blur/colorize(255,0,0,100)/gray/height(500)/negate/rotate(35)/workspace/image.jpg', $src);
    }

    public function testSkipCDN()
    {
        $asset = Asset::fromArray(['asset' => ['workspace' => 'workspace', 'path' => 'image.jpg'], 'meta' => []]);

        $src = ImageBuilder::fromAsset($asset)
            ->skipCdn()
            ->useCdn()
            ->skipCdn()
            ->getSourceUrl()
        ;
        $this->assertEquals('https://assets-nocdn.seams-cms.com/workspace/image.jpg', $src);
    }

    public function testFilters()
    {
        $asset = Asset::fromArray(['asset' => ['workspace' => 'workspace', 'path' => 'image.jpg'], 'meta' => []]);

        $src = ImageBuilder::fromAsset($asset)
            ->skipCdn()
            ->useCdn()
            ->blur()
            ->colorize(1, 2, 3, 4)
            ->crop(ImageBuilder::CROP_BOTTOM, 100, 100)
            ->cropsides()
            ->flip(ImageBuilder::FLIP_BOTH)
            ->gray()
            ->height(100)
            ->negate()
            ->rotate(90)
            ->width(100)
            ->getSourceUrl()
        ;

        $this->assertEquals('https://assets.seams-cms.com/p/blur/colorize(1,2,3,4)/crop(bottom,100,100)/cropsides/flip(both)/gray/height(100)/negate/rotate(90)/width(100)/workspace/image.jpg', $src);
    }

    public function testWebp()
    {
        $src = ImageBuilder::fromPath('foo', 'bar.png')->getSourceUrl();
        $this->assertEquals('https://assets.seams-cms.com/foo/bar.png', $src);

        $src = ImageBuilder::fromPath('foo', 'bar.png')->asWebp()->getSourceUrl();
        $this->assertEquals('https://assets.seams-cms.com/foo/bar.png.webp', $src);
    }
}
