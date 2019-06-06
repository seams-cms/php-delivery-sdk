<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class ContentType
{
    use HydratorTrait {
        fromArray as private fromArrayTrait;
    }

    /** @var string */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $description;
    /** @var ContentTypeField[] */
    private $fields;

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
     * @return ContentTypeField[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    public static function fromArray(array $data)
    {
        $data['fields'] = array_map(function ($item) {
            return ContentTypeField::fromArray($item);
        }, $data['fields']);

        return self::fromArrayTrait($data);
    }
}
