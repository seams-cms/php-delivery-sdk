<?php
declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class WorkspaceCollectionEntry
{
    use HydratorTrait {
        fromArray as private fromArrayTrait;
    }

    /** @var string */
    protected $id;
    /** @var string */
    protected $name;
    /** @var string */
    protected $description;
    /** @var bool */
    protected $isArchived;
    /** @var string */
    protected $organisation;

    /** @var Locale[] */
    protected $locales;

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

    public static function fromArray(array $data)
    {
        $data['locales'] = array_map(
            function ($item) {
                return Locale::fromArray($item);
            },
            $data['locales']
        );

        return self::fromArrayTrait($data);
    }
}
