<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

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
     * @return Collection
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
