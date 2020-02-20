<?php

declare(strict_types=1);

/*
 * This file is part of the Seams-CMS Delivery SDK package.
 *
 * (c) Seams-CMS.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeamsCMS\Delivery\Model;

/**
 * Class Locale
 * @package SeamsCMS\Delivery\Model
 */
class Locale
{
    use HydratorTrait;

    /** @var string */
    protected $name = "";
    /** @var string */
    protected $locale = "";


    /**
     * Locale constructor.
     *
     */
    final protected function __construct()
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
    public function getLocale(): string
    {
        return $this->locale;
    }
}
