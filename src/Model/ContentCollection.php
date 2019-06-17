<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class ContentCollection extends Collection
{
    /** @return Content[] */
    public function getEntries(): array
    {
        return parent::getEntries();
    }

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
