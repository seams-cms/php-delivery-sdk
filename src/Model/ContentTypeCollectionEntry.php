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
 * Class ContentTypeCollectionEntry
 * @package SeamsCMS\Delivery\Model
 */
class ContentTypeCollectionEntry
{
    use HydratorTrait;

    /** @var string */
    private $id = "";
    /** @var string */
    private $name = "";
    /** @var string */
    private $description = "";
    /** @var int */
    private $entryCount = 0;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getEntryCount()
    {
        return $this->entryCount;
    }
}
