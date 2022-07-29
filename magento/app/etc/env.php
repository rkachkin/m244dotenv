<?php
return [
    'backend' => [
        'frontName' => $_ENV['BACKEND_NAME']
    ],
    'remote_storage' => [
        'driver' => 'file'
    ],
    'queue' => [
        'consumers_wait_for_messages' => 1
    ],
    'crypt' => [
        'key' => $_ENV['CRYPT_KEY'],
    ],
    'db' => [
        'table_prefix' => $_ENV['DB_TABLE_PREFIX'],
        'connection' => [
            'default' => [
                'host' => !empty($_ENV["DB_PORT"])
                    ? $_ENV["DB_HOST"] . ':' . $_ENV["DB_PORT"]
                    : $_ENV["DB_HOST"],
                'dbname' => $_ENV["DB_DATABASE"],
                'username' => $_ENV["DB_USERNAME"],
                'password' => $_ENV["DB_PASSWORD"],
                'model' => 'mysql4',
                'engine' => 'innodb',
                'initStatements' => 'SET NAMES utf8;',
                'active' => '1',
                'driver_options' => [
                    1014 => false
                ]
            ]
        ]
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => $_ENV['MAGE_MODE'],
    'session' => [
        'save' => 'files'
    ],
    'cache' => [
        'frontend' => [
            'default' => [
                'id_prefix' => $_ENV['CACHE_ID_PREFIX'],
            ],
            'page_cache' => [
                'id_prefix' => $_ENV['CACHE_ID_PREFIX'],
            ]
        ],
        'allow_parallel_generation' => false
    ],
    'lock' => [
        'provider' => 'db',
        'config' => [
            'prefix' => null
        ]
    ],
    'directories' => [
        'document_root_is_pub' => true
    ],
    'modules' => [
        'Magento_TwoFactorAuth' => $_ENV['APP_ENV'] === 'prod',
    ],
    'system' => [
        'default' => [
            'catalog' => [
                'search' => [
                    'elasticsearch7_server_hostname' => $_ENV['ELASTIC_HOST']
                ]
            ]
        ]
    ]
];
