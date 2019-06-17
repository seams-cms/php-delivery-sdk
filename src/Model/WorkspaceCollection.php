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
 * Class WorkspaceCollection
 * @package SeamsCMS\Delivery\Model
 */
class WorkspaceCollection extends Collection
{
    /** @var WorkspaceCollectionEntry[] */
    protected $entries;

    /**
     * @return WorkspaceCollectionEntry[]
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    /**
     * @param array $data
     * @return Collection
     */
    public static function fromArray(array $data)
    {
        $data['entries'] = array_map(
            function ($item) {
                return WorkspaceCollectionEntry::fromArray($item);
            },
            $data['entries']
        );

        return parent::fromArray($data);
    }
}
