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

/**
 * Class ContentCollection
 * @package SeamsCMS\Delivery\Model
 */
class ContentCollection extends Collection
{
    /** @var Content[] */
    protected $entries;

    /**
     * @return Content[]
     */
    public function getEntries(): array
    {
        return parent::getEntries();
    }

    /**
     * @param array $data
     * @return ContentCollection
     */
    public static function fromArray(array $data)
    {
        $data['entries'] = array_map(
            function ($item) {
                return Content::fromArray($item);
            },
            $data['entries']
        );

        return parent::fromArray($data);
    }
}
