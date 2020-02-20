<?php

declare(strict_types=1);

/*
 * This file is part of the SeamsCMSDeliverySdk package.
 *
 * (c) Seams-CMS.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeamsCMS\Delivery;

/**
 * Class Filter
 * @package SeamsCMS\Delivery
 */
class Filter
{
    /** @var int */
    protected $offset = 0;

    /** @var int */
    protected $limit = 100;

    /** @var string */
    protected $sort = "";

    /** @var string */
    protected $query = "";

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return void
     */
    public function setOffset(int $offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return void
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return string
     */
    public function getSort(): string
    {
        return $this->sort;
    }

    /**
     * @param string $sort
     * @return void
     */
    public function setSort(string $sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @param string $query
     * @return void
     */
    public function setQuery(string $query)
    {
        $this->query = $query;
    }
}
