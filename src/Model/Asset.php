<?php

declare(strict_types=1);

/*
 * This file is part of the -SeamsCMSDeliverySdk package.
 *
 * (c) Seams-CMS.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeamsCMS\Delivery\Model;

/**
 * Class Asset
 * @package SeamsCMS\Delivery\Model
 */
class Asset
{
    use HydratorTrait {
        fromArray as private fromArrayTrait;
    }

    /** @var string */
    private $link;
    /** @var string|null */
    private $thumbnailLink;
    /** @var int */
    private $size;
    /** @var string */
    private $path;
    /** @var string */
    private $title;
    /** @var string */
    private $mimetype;
    /** @var string */
    private $workspace;
    /** @var AssetMeta */
    private $meta;

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @return string|null
     */
    public function getThumbnailLink()
    {
        return $this->thumbnailLink;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getMimetype(): string
    {
        return $this->mimetype;
    }

    /**
     * @return string
     */
    public function getWorkspace(): string
    {
        return $this->workspace;
    }

    /**
     * @return AssetMeta
     */
    public function getMeta(): AssetMeta
    {
        return $this->meta;
    }

    /**
     * @param array $data
     * @return Asset
     */
    public static function fromArray(array $data)
    {
        $meta = AssetMeta::fromArray($data['meta']);
        $data = $data['asset'];
        $data['meta'] = $meta;

        return self::fromArrayTrait($data);
    }
}
