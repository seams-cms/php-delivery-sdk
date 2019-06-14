<?php
declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class Locale
{
    use HydratorTrait;

    /** @var string */
    protected $name;
    /** @var string */
    protected $locale;

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
