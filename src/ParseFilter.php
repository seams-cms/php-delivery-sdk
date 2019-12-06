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

namespace SeamsCMS\Delivery;

use function GuzzleHttp\Psr7\build_query;

/**
 * Class Filter
 * @package SeamsCMS\Delivery
 */
class ParseFilter
{
    /**
     * @param Filter|null $filter
     * @return string
     */
    public static function generateQueryString(Filter $filter = null): string
    {
        if (is_null($filter)) {
            return "";
        }

        $params = [];
        $params['offset'] = $filter->getOffset();
        $params['limit'] = $filter->getLimit();
        if (! empty($filter->getSort())) {
            $params['sort'] = $filter->getSort();
        }
        if (! empty($filter->getQuery())) {
            $params['query'] = $filter->getQuery();
        }

        return build_query($params);
    }
}
