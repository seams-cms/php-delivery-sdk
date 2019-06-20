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

namespace SeamsCMS\Delivery\Exception;

class InvalidFieldsException extends BaseException implements SeamsCMSException
{
    public static function metaNotFound()
    {
        return new self("Field 'meta' not found");
    }

    public static function fieldsNotFound()
    {
        return new self("Field 'fields' not found");
    }
}
