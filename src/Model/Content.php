<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class Content extends Model
{
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
        'content' => [
            'type' => Model::TYPE_CONTENT,
        ],
    ];
}
