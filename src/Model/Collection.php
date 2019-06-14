<?php
declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

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

    public static function fromArray(array $data)
    {
        $data['meta'] = CollectionMeta::fromArray($data['meta']);

        return self::fromArrayTrait($data);
    }
}
