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
 * Class ContentMeta
 * @package SeamsCMS\Delivery\Model
 */
class ContentMeta
{
    use HydratorTrait {
        fromArray as private fromArrayTrait;
    }

    /** @var string */
    private $revisionId = "";
    /** @var string */
    private $entryId = "";
    /** @var string */
    private $contentType = "";
    /** @var \DateTimeImmutable */
    private $createdAt;
    /** @var string */
    private $createdBy = "";
    /** @var \DateTimeImmutable */
    private $updatedAt;
    /** @var string */
    private $updatedBy = "";


    /**
     * ContentMeta constructor.
     *
     */
    final protected function __construct()
    {
    }

    /**
     * @return string
     */
    public function getRevisionId(): string
    {
        return $this->revisionId;
    }

    /**
     * @return string
     */
    public function getEntryId(): string
    {
        return $this->entryId;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getCreatedBy(): string
    {
        return $this->createdBy;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getUpdatedBy(): string
    {
        return $this->updatedBy;
    }

    /**
     * @param array $data
     * @return ContentMeta
     */
    public static function fromArray(array $data)
    {
        if (isset($data['created_at'])) {
            $data['created_at'] = new \DateTimeImmutable($data['created_at']);
        }
        if (isset($data['updated_at'])) {
            $data['updated_at'] = new \DateTimeImmutable($data['updated_at']);
        }

        if (isset($data['type_id'])) {
            $data['contentType'] = $data['type_id'];
        }

        return self::fromArrayTrait($data);
    }
}
