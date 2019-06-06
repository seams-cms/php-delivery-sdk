<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class WorkspaceCollection2 extends Model implements \ArrayAccess, \Iterator
{
    protected $entries;

    public function __construct(string $json)
    {
        parent::__construct($json);
        $this->entries = $this->get('[entries]');
    }

    public static $model = [
        'meta' => [
            'type' => Model::TYPE_ARRAY,
            'model' => [
                'offset' => [
                    'type' => Model::TYPE_INTEGER,
                ],
                'limit' => [
                    'type' => Model::TYPE_INTEGER,
                ],
                'total' => [
                    'type' => Model::TYPE_INTEGER,
                ],
            ],
        ],
        'entries' => [
            'type' => Model::TYPE_COLLECTION,
            'model' => [
                'id' => [
                    'type' => Model::TYPE_STRING,
                 ],
                'name' => [
                    'type' => Model::TYPE_STRING,
                ],
                'description' => [
                    'type' => Model::TYPE_STRING,
                ],
                'is_archived' => [
                    'type' => Model::TYPE_BOOLEAN,
                ],
                'count' => [
                    'type' => Model::TYPE_ARRAY,
                    'model' => [
                        'types' => [
                            'type' => Model::TYPE_INTEGER,
                        ],
                        'entries' => [
                            'type' => Model::TYPE_INTEGER,
                        ],
                        'assets' => [
                            'type' => Model::TYPE_INTEGER,
                        ],
                    ],
                ],
                'locales' => [
                    'type' => Model::TYPE_COLLECTION,
                    'model' => [
                        'name' => [
                            'type' => Model::TYPE_STRING,
                        ],
                        'locale' => [
                            'type' => Model::TYPE_STRING,
                        ],
                    ],
                ],
            ],
        ],
    ];

    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return current($this->entries);
    }

    /**
     * Move forward to next element
     * @link https://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        return next($this->entries);
    }

    /**
     * Return the key of the current element
     * @link https://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return key($this->entries);
    }

    /**
     * Checks if current position is valid
     * @link https://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return $this->key() !== null;
    }

    /**
     * Rewind the Iterator to the first element
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        return reset($this->entries);
    }

    /**
     * Whether a offset exists
     * @link https://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->entries);
    }

    /**
     * Offset to retrieve
     * @link https://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     *
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->entries[$offset];
    }

    /**
     * Offset to set
     * @link https://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->entries[$offset] = $value;
    }

    /**
     * Offset to unset
     * @link https://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->entries[$offset]);
    }
}
