<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class ContentType extends Model
{
    public static $model = [
        'id' => [
            'type' => Model::TYPE_STRING,
         ],
        'name' => [
            'type' => Model::TYPE_STRING,
        ],
        'description' => [
            'type' => Model::TYPE_STRING,
        ],
        'fields' => [
            'type' => Model::TYPE_COLLECTION,
            'model' => [
                'name' => [
                    'type' => Model::TYPE_STRING,
                 ],
                'description' => [
                    'type' => Model::TYPE_STRING,
                ],
                'type' => [
                    'type' => Model::TYPE_STRING,
                ],
                'is_localized' => [
                    'type' => Model::TYPE_BOOLEAN,
                ],
                'is_required' => [
                    'type' => Model::TYPE_BOOLEAN,
                ],
            ],
        ],
    ];
}
