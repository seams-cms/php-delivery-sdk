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
 * Class ContentTypeField
 * @package SeamsCMS\Delivery\Model
 */
class ContentTypeField
{
    use HydratorTrait;

    /** @var string */
    private $name = "";
    /** @var string */
    private $description = "";
    /** @var string */
    private $type = "";
    /** @var bool */
    private $isLocalized = false;
    /** @var bool */
    private $isRequired = false;


    /**
     * ContentTypeField constructor.
     *
     */
    protected function __construct()
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isLocalized(): bool
    {
        return $this->isLocalized;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->isRequired;
    }
}
