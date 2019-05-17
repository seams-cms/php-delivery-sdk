<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class AssetCollection extends Model
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
                'link' => [
                    'type' => Model::TYPE_STRING,
                 ],
                'thumbnail_link' => [
                    'type' => Model::TYPE_STRING,
                ],
                'size' => [
                    'type' => Model::TYPE_INTEGER,
                ],
                'path' => [
                    'type' => Model::TYPE_STRING,
                ],
                'title' => [
                    'type' => Model::TYPE_STRING,
                ],
                'mimetype' => [
                    'type' => Model::TYPE_STRING,
                ],
                'created_at' => [
                    'type' => Model::TYPE_DATETIME,
                ],
                'created_by' => [
                    'type' => Model::TYPE_STRING,
                ],
            ],
         ],
    ];
}
