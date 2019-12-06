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
 * Class WorkspaceCollectionEntry
 * @package SeamsCMS\Delivery\Model
 */
class WorkspaceCollectionEntry
{
    use HydratorTrait {
        fromArray as private fromArrayTrait;
    }

    /** @var string */
    protected $id = "";
    /** @var string */
    protected $name = "";
    /** @var string */
    protected $description = "";
    /** @var bool */
    protected $isArchived = false;
    /** @var string */
    protected $organisation = "";
    /** @var Locale[] */
    protected $locales = [];


    /**
     * WorkspaceCollectionEntry constructor.
     *
     */
    protected function __construct()
    {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->isArchived;
    }

    /**
     * @return string
     */
    public function getOrganisation(): string
    {
        return $this->organisation;
    }

    /**
     * @return Locale[]
     */
    public function getLocales(): array
    {
        return $this->locales;
    }

    /**
     * @param array $data
     * @return WorkspaceCollectionEntry
     */
    public static function fromArray(array $data)
    {
        $data['locales'] = array_map(
            function ($item) {
                return Locale::fromArray($item);
            },
            $data['locales'] ?? []
        );

        return self::fromArrayTrait($data);
    }
}
