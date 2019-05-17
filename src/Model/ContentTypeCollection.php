<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class ContentTypeCollection extends Model
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
                'entry_count' => [
                    'type' => Model::TYPE_INTEGER,
                ],
            ],
         ],
    ];
}
