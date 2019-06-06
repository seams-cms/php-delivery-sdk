<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class Asset
{
    /** @var string */
    protected $workspace;
    /** @var string */
    protected $path;

    /**
     * Asset constructor.
     *
     * @param string $workspace
     * @param string $path
     */
    public function __construct(string $workspace, string $path)
    {
        $this->workspace = $workspace;
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getWorkspace(): string
    {
        return $this->workspace;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}
