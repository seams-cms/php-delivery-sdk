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
 * Class ContentType
 * @package SeamsCMS\Delivery\Model
 */
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
     * ContentType constructor.
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
     * @return ContentTypeField[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $data
     * @return ContentType
     */
    public static function fromArray(array $data)
    {
        $data['fields'] = array_map(function ($item) {
            return ContentTypeField::fromArray($item);
        }, $data['fields']);

        return self::fromArrayTrait($data);
    }
}
