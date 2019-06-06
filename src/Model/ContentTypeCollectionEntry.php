<?php
declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class ContentTypeCollectionEntry
{
    use HydratorTrait;

    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $description;
    /** @var int */
    private $entryCount;

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
