<?php

declare(strict_types=1);

/*
 * This file is part of the Seams-CMS Delivery SDK package.
 *
 * (c) Seams-CMS.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeamsCMS\Delivery\Model;

use SeamsCMS\Delivery\Exception\MissingFieldsException;

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
     * Collection constructor.
     *
     */
    protected function __construct()
    {
    }

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
     * @return mixed
     */
    public static function fromArray(array $data)
    {
        if (! isset($data['meta'])) {
            throw MissingFieldsException::metaNotFound();
        }

        $data['meta'] = CollectionMeta::fromArray($data['meta']);

        return self::fromArrayTrait($data);
    }
}
