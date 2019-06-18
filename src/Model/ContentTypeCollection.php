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
 * Class ContentTypeCollection
 * @package SeamsCMS\Delivery\Model
 */
class ContentTypeCollection extends Collection
{
    /** @var ContentTypeCollectionEntry[] */
    protected $entries;

    /**
     * @return ContentTypeCollectionEntry[]
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    /**
     * @param array $data
     * @return ContentTypeCollection
     */
    public static function fromArray(array $data)
    {
        $data['entries'] = array_map(
            function ($item) {
                return ContentTypeCollectionEntry::fromArray($item);
            },
            $data['entries']
        );

        return parent::fromArray($data);
    }
}
