<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

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
