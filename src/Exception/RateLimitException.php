<?php

declare(strict_types=1);

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
