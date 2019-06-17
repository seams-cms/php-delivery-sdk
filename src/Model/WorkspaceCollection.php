<?php
declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

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

    public static function fromArray(array $data)
    {
//        var_dump($data);
//        $data['entries'] = array_map(
//            function ($item) {
//                return WorkspaceCollectionEntry::fromArray($item);
//            },
//            $data['entries']
//        );

        return parent::fromArray($data);
    }
}
