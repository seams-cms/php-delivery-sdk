<?php
declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class AssetMeta
{
    use HydratorTrait {
        fromArray as private fromArrayTrait;
    }

    /** @var \DateTimeImmutable */
    private $createdAt;
    /** @var string */
    private $createdBy;
    /** @var \DateTimeImmutable */
    private $updatedAt;
    /** @var string */
    private $updatedBy;

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
        if (isset($data['created_at'])) {
            $data['created_at'] = new \DateTimeImmutable($data['created_at']);
        }
        if (isset($data['updated_at'])) {
            $data['updated_at'] = new \DateTimeImmutable($data['updated_at']);
        }

        return self::fromArrayTrait($data);
    }
}
