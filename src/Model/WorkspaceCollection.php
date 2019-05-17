<?php

declare(strict_types=1);

namespace SeamsCMS\Delivery\Model;

class WorkspaceCollection extends Model
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
                'is_archived' => [
                    'type' => Model::TYPE_BOOLEAN,
                ],
                'count' => [
                    'type' => Model::TYPE_ARRAY,
                    'model' => [
                        'types' => [
                            'type' => Model::TYPE_INTEGER,
                        ],
                        'entries' => [
                            'type' => Model::TYPE_INTEGER,
                        ],
                        'assets' => [
                            'type' => Model::TYPE_INTEGER,
                        ],
                    ],
                ],
                'locales' => [
                    'type' => Model::TYPE_COLLECTION,
                    'model' => [
                        'name' => [
                            'type' => Model::TYPE_STRING,
                        ],
                        'locale' => [
                            'type' => Model::TYPE_STRING,
                        ],
                    ],
                ],
            ],
        ],
    ];
}
