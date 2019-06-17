<?php

declare(strict_types=1);

/*
 * This file is part of the SeamsCMSDeliveryBundle package.
 *
 * (c) Seams-CMS.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeamsCMS\Delivery\Exception;

class RateLimitException extends BaseException implements SeamsCMSException
{
    /** @var int */
    protected $limit;

    /** @var int */
    protected $resetTimestamp;

    /**
     * RateLimitException constructor.
     *
     * @param int $limit
     * @param int $resetTimestamp
     * @param string $msg
     */
    public function __construct(int $limit, int $resetTimestamp, string $msg)
    {
        $this->limit = $limit;
        $this->resetTimestamp = $resetTimestamp;

        parent::__construct($msg);
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
    public function getResetTimestamp(): int
    {
        return $this->resetTimestamp;
    }
}
