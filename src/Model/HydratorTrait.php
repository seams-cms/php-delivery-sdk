<?php

declare(strict_types=1);

/*
 * This file is part of the SeamsCMSDeliveryBundle package.
 *
 * (c) Seams-CMS.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeamsCMS\Delivery\Model;

use GeneratedHydrator\Configuration;

/**
 * Trait HydratorTrait
 * @package SeamsCMS\Delivery\Model
 */
trait HydratorTrait
{
    private static $hydrators = array();

    /**
     * @param array $data
     * @return HydratorTrait
     */
    public static function fromArray(array $data)
    {
        $data = self::convertNames($data);

        $hydrator = self::getHydrator();
        $object = new static();

        $hydrator->hydrate($data, $object);

        return $object;
    }

    /**
     * Returns an array where all keys have been converted from snake_case to camelCase
     *
     * @param array $data
     *
     * @return array
     */
    private static function convertNames(array $data): array
    {
        $result = [];

        foreach ($data as $key => $value) {
            $parts = explode('_', $key);
            foreach ($parts as &$part) {
                $part = ucfirst($part);
            }
            $key = implode("", $parts);
            $key = lcfirst($key);
            $result[$key] = $value;
        }

        return $result;
    }

    /**
     * @return mixed
     */
    private static function getHydrator()
    {
        $className = static::class;

        if (!isset(self::$hydrators[$className])) {
            $configuration = new Configuration($className);
            $hydratorClass = $configuration->createFactory()->getHydratorClass();
            self::$hydrators[$className] = new $hydratorClass();
        }

        return self::$hydrators[$className];
    }
}
