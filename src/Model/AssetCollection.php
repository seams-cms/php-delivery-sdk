<?php

declare(strict_types=1);

/*
 * This file is part of the SeamsCMSDeliveryBundle package.
 *
 * (c) Seams-CMS.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeamsCMS\Delivery\Model;

/**
 * Class AssetCollection
 * @package SeamsCMS\Delivery\Model
 */
class AssetCollection extends Collection
{
    /** @var Asset[] */
    protected $entries;

    /**
     * @return Asset[]
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    /**
     * @param array $data
     * @return AssetCollection|Collection
     */
    public static function fromArray(array $data)
    {
        $data['entries'] = array_map(
            function ($item) {
                return Asset::fromArray($item);
            },
            $data['entries']
        );

        return parent::fromArray($data);
    }
}
