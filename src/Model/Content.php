<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class Content
{
    use HydratorTrait {
        fromArray as fromArrayTrait;
    }

    /** @var ContentMeta */
    private $meta;
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

    public static function fromArray(array $data)
    {
        $data['meta'] = ContentMeta::fromArray($data['meta']);

        foreach ($data['content'] as $key => $item) {
            if (is_array($item['value'])) {
                if (isset($item['value']['meta'])) {
                    $data['content'][$key]['value'] = Content::fromArray($item['value']);
                } else {
                    $data['content'][$key]['value'] = array_map(
                        function ($value) {
                            return Content::fromArray($value);
                        },
                        $item['value']
                    );
                }
            }
        }

        return self::fromArrayTrait($data);
    }
}
