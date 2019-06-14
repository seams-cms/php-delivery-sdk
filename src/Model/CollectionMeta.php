<?php
declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class CollectionMeta
{
    use HydratorTrait;

    /** @var int */
    private $limit;
    /** @var int */
    private $offset;
    /** @var int */
    private $total;

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }
}
