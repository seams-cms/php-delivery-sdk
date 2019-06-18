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
 * Class Collection
 * @package SeamsCMS\Delivery\Model
 */
abstract class Collection
{
    use HydratorTrait {
        fromArray as private fromArrayTrait;
    }

    /** @var array */
    protected $entries;

    /** @var CollectionMeta */
    protected $meta;

    /**
     * @return array
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    /**
     * @return CollectionMeta
     */
    public function getMeta(): CollectionMeta
    {
        return $this->meta;
    }

    /**
     * @param array $data
     * @return Collection
     */
    public static function fromArray(array $data)
    {
        $data['meta'] = CollectionMeta::fromArray($data['meta']);

        return self::fromArrayTrait($data);
    }
}
