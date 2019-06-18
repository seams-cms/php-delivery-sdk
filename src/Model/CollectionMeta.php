<?php

declare(strict_types=1);

/*
 * This file is part of the -SeamsCMSDeliverySdk package.
 *
 * (c) Seams-CMS.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeamsCMS\Delivery\Model;

/**
 * Class CollectionMeta
 * @package SeamsCMS\Delivery\Model
 */
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
     * CollectionMeta constructor.
     *
     */
    protected function __construct()
    {
    }

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
