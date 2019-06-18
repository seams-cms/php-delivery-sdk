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
 * Class Content
 * @package SeamsCMS\Delivery\Model
 */
class Content
{
    use HydratorTrait {
        fromArray as fromArrayTrait;
    }

    /** @var array */
    private $content;

    /**
     * @param string $field
     * @param string|null $locale
     * @param string|null $fallbackLocale
     *
     * @return scalar|Content|Content[]|null
     */
    public function get($field, string $locale = null, string $fallbackLocale = null)
    {
        if ($locale && $this->has($field, $locale)) {
            return $this->content[$field]['locales'][$locale];
        }

        if ($fallbackLocale && $this->has($field, $fallbackLocale)) {
            return $this->content[$field]['locales'][$fallbackLocale];
        } elseif ($this->has($field)) {
            return $this->content[$field]['value'];
        }

        return null;
    }

    /**
     * @param string $field
     * @param string|null $locale
     *
     * @return bool
     */
    public function has(string $field, string $locale = null): bool
    {
        if ($locale) {
            return isset($this->content[$field]['locales'][$locale]);
        }

        return isset($this->content[$field]['value']);
    }

    /**
     * @param string $field
     *
     * @return bool True if the field exists and is localized, false otherwise
     */
    public function isLocalized(string $field): bool
    {
        return !empty($this->content[$field]['locales']);
    }

    /**
     * @param array $data
     * @return Content
     */
    public static function fromArray($data)
    {
        $data['meta'] = ContentMeta::fromArray($data['meta']);

        foreach ($data['content'] as $key => $item) {
            $item['value'] = static::convert($item['value']);

            foreach ($item['locales'] as $localizedKey => $localizedItem) {
                $item['locales'][$localizedKey] = static::convert($localizedItem);
            }

            $data['content'][$key] = $item;
        }

        return self::fromArrayTrait($data);
    }

    /**
     * @param mixed $item
     * @return array|mixed
     */
    public static function convert($item)
    {
        // Scalar string doesn't need to be converted
        if (!is_array($item)) {
            return $item;
        }

        // Are we an (indexed) list?
        foreach ($item as $listIndex => $listItem) {
            // Do we have meta and content? Then we assume we are (recursive) content
            if (isset($listItem['meta']) && isset($listItem['content'])) {
                $item[$listIndex] = static::fromArray($listItem);
            }
        }

        return $item;
    }
}
