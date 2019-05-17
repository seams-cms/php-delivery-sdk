<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class ContentCollection extends Model
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
                'meta' => [
                    'type' => Model::TYPE_ARRAY,
                    'model' => [
                        'id' => [
                            'type' => Model::TYPE_STRING,
                        ],
                        'created_at' => [
                            'type' => Model::TYPE_DATETIME,
                        ],
                        'created_by' => [
                            'type' => Model::TYPE_STRING,
                        ],
                        'status' => [
                            'type' => Model::TYPE_STRING,
                        ],
                    ],
                 ],
                'content' => [
                    'type' => Model::TYPE_CONTENT,
                ],
            ],
        ],
    ];
}
