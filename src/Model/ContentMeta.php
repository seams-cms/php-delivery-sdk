<?php
declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class ContentMeta
{
    use HydratorTrait {
        fromArray as private fromArrayTrait;
    }

    /** @var string */
    private $revisionId;
    /** @var string */
    private $entryId;
    /** @var string */
    private $contentType;
    /** @var \DateTimeImmutable */
    private $createdAt;
    /** @var string */
    private $createdBy;
    /** @var \DateTimeImmutable */
    private $updatedAt;
    /** @var string */
    private $updatedBy;

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

    public static function fromArray(array $data)
    {
        return self::fromArrayTrait($data);
    }
}
