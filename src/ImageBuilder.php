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

namespace SeamsCMS\Delivery;

use SeamsCMS\Delivery\Model\Asset;

/**
 * Class ImageBuilder
 * @package SeamsCMS\Delivery
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class ImageBuilder
{
    const ASSET_BASE_URL_CDN = "https://assets.seams-cms.com";
    const ASSET_BASE_URL = "https://assets-nocdn.seams-cms.com";

    const CROP_TOP_LEFT = "topleft";
    const CROP_TOP = "top";
    const CROP_TOP_RIGHT = "topright";
    const CROP_LEFT = "left";
    const CROP_CENTER = "center";
    const CROP_RIGHT = "right";
    const CROP_BOTTOM_LEFT = "bottomleft";
    const CROP_BOTTOM = "bottom";
    const CROP_BOTTOM_RIGHT = "bottomright";

    const FLIP_HORIZONTAL = "horizontal";
    const FLIP_VERTICAL = "vertical";
    const FLIP_BOTH = "both";

    /** @var array */
    protected $filters = array();


    /** @var string */
    protected $workspace;
    /** @var string */
    protected $path;

    /** @var bool */
    protected $cdn = false;

    /**
     * @param Asset $asset
     * @return ImageBuilder
     */
    public static function fromAsset(Asset $asset)
    {
        return new self($asset->getWorkspace(), $asset->getPath());
    }

    /**
     * @param string $workspace
     * @param string $path
     * @return ImageBuilder
     */
    public static function fromPath(string $workspace, string $path)
    {
        return new self($workspace, $path);
    }

    /**
     * ImageBuilder constructor.
     *
     * @param string $workspace
     * @param string $path
     */
    protected function __construct(string $workspace, string $path)
    {
        $this->workspace = $workspace;
        $this->path = $path;

        $this->cdn = true;
    }

    /**
     * Skips the CDN host and uses the direct asset API.
     *
     * Note that this should not be used for production purposes.
     *
     * @return ImageBuilder
     */
    public function skipCdn(): ImageBuilder
    {
        $this->cdn = false;

        return $this;
    }

    /**
     * Uses the CDN host.
     *
     * @return self
     */
    public function useCdn(): self
    {
        $this->cdn = true;

        return $this;
    }

    /**
     * @return ImageBuilder
     */
    public function blur(): self
    {
        $this->filters[] = 'blur';

        return $this;
    }

    /**
     * @param int $red
     * @param int $green
     * @param int $blue
     * @param int $alpha
     * @return ImageBuilder
     */
    public function colorize(int $red, int $green, int $blue, int $alpha): self
    {
        $this->filters[] = sprintf('colorize(%d,%d,%d,%d)', $red, $green, $blue, $alpha);

        return $this;
    }

    /**
     * @param string $position One of the CROP_* constants
     * @param int $width
     * @param int $height
     * @return ImageBuilder
     */
    public function crop(string $position = self::CROP_CENTER, int $width = 100, int $height = 100): self
    {
        $this->filters[] = sprintf('crop(%s,%d,%d)', $position, $width, $height);

        return $this;
    }

    /**
     * @return ImageBuilder
     */
    public function cropsides(): self
    {
        $this->filters[] = 'cropsides';

        return $this;
    }

    /**
     * @param string $direction One of the FLIP_* constants
     * @return ImageBuilder
     */
    public function flip(string $direction = self::FLIP_HORIZONTAL): self
    {
        $this->filters[] = sprintf('flip(%s)', $direction);

        return $this;
    }

    /**
     * @return ImageBuilder
     */
    public function gray(): self
    {
        $this->filters[] = 'gray';

        return $this;
    }

    /**
     * @param int $height
     * @return ImageBuilder
     */
    public function height(int $height): self
    {
        $this->filters[] = sprintf('height(%d)', $height);

        return $this;
    }

    /**
     * @return ImageBuilder
     */
    public function negate(): self
    {
        $this->filters[] = 'negate';

        return $this;
    }

    /**
     * @param int $angle
     * @return ImageBuilder
     */
    public function rotate(int $angle): self
    {
        $this->filters[] = sprintf('rotate(%d)', $angle);

        return $this;
    }

    /**
     * @param int $width
     * @return ImageBuilder
     */
    public function width(int $width): self
    {
        $this->filters[] = sprintf('width(%d)', $width);

        return $this;
    }

    /**
     * Returns the actual URL to the image.
     *
     * @return string
     */
    public function getSourceUrl(): string
    {
        $url = sprintf("%s/%s", $this->workspace, $this->path);

        // Add filters if any are found
        if (count($this->filters) > 0) {
            $sortedFilters = $this->filters;
            sort($sortedFilters);

            $url = sprintf('p/%s/%s', join('/', $sortedFilters), $url);
        }

        return sprintf("%s/%s", $this->cdn ? self::ASSET_BASE_URL_CDN : self::ASSET_BASE_URL, $url);
    }
}
