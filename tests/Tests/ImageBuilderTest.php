<?php

namespace SeamsCMS\Delivery\Tests;

use PHPUnit\Framework\TestCase;
use SeamsCMS\Delivery\ImageBuilder;
use SeamsCMS\Delivery\Model\Asset;

class ImageBuilderTest extends TestCase
{
    public function testSimpleImage()
    {
        $asset = new Asset("workspace", "image.jpg");

        $src = ImageBuilder::fromAsset($asset)->getSourceUrl();
        $this->assertEquals('https://assets.seams-cms.com/workspace/image.jpg', $src);
    }

    public function testComplexImage()
    {
        $asset = new Asset("workspace", "image.jpg");

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
}
