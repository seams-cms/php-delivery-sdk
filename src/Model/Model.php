<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class Model
{
    const TYPE_STRING = "string";
    const TYPE_INTEGER = "integer";
    const TYPE_BOOLEAN = "boolean";
    const TYPE_DATETIME = "datetime";
    const TYPE_COLLECTION = "collection";
    const TYPE_ARRAY = "array";
    const TYPE_CONTENT = "content";

    /** @var PropertyAccessorInterface */
    protected $accessor;

    /** @var array */
    protected $data;

    /** @var array */
    public static $model = [];

    /**
     * Model constructor.
     *
     * @param string $json
     */
    public function __construct(string $json)
    {
        $data = json_decode($json, true);
        if ($data === false) {
            throw new \LogicException("Data is not valid JSON");
        }

        $this->verify(static::$model, $data);

        $this->accessor = PropertyAccess::createPropertyAccessorBuilder()
            ->disableExceptionOnInvalidIndex()
            ->disableMagicCall()
            ->getPropertyAccessor()
        ;

        $this->data = $data;
    }

    /**
     * @param string $path
     * @return int
     */
    public function count(string $path): int
    {
        $var = $this->accessor->getValue($this->data, $path);

        if (! is_array($var)) {
            return 1;
        }

        return count($var);
    }

    /**
     * @param string $path
     * @return bool
     */
    public function has(string $path): bool
    {
        return $this->accessor->isReadable($this->data, $path);
    }

    /**
     * @param string $path
     * @param null $default
     * @return mixed
     */
    public function get(string $path, $default = null)
    {
        if (! $this->accessor->isReadable($this->data, $path)) {
            return $default;
        }

        return $this->accessor->getValue($this->data, $path);
    }

    /**
     * @param array $model
     * @param array $data
     * @param string $currentPath
     */
    private function verify(array $model, array $data, string $currentPath = "")
    {
        foreach ($model as $id => $field) {
            if (! isset($field['type'])) {
                $field['type'] = self::TYPE_STRING;
            }

            if (! isset($data[$id])) {
                throw new \LogicException("Data is not found: $currentPath.$id");
            }


            // Check if type and data[id] match up
            $valid = false;
            switch ($field['type']) {
                case self::TYPE_ARRAY:
                    $valid = is_array($data[$id]);
                    break;
                case self::TYPE_COLLECTION:
                    $valid = is_array($data[$id]);
                    break;
                case self::TYPE_BOOLEAN:
                    $valid = is_bool($data[$id]);
                    break;
                case self::TYPE_INTEGER:
                    $valid = is_int($data[$id]);
                    break;
                case self::TYPE_STRING:
                    $valid = is_string($data[$id]);
                    break;
                case self::TYPE_CONTENT:
                    $valid = true;
                    break;
                case self::TYPE_DATETIME:
                    try {
                        new \DateTime($data[$id]);
                        $valid = true;
                    } catch (\Exception $e) {
                        $valid = false;
                    }
                    break;
            }

            if (! $valid) {
                throw new \LogicException("Data is not valid according to model: $currentPath.$id");
            }

            // Check collections recursively
            if ($field['type'] === self::TYPE_COLLECTION) {
                foreach ($data[$id] as $entry) {
                    $this->verify($field['model'] ?? [], $entry, $currentPath . "." . $id);
                }
            }

            // Check arrays recursively
            if ($field['type'] === self::TYPE_ARRAY) {
                $this->verify($field['model'] ?? [], $data[$id], $currentPath . "." . $id);
            }
        }
    }
}
