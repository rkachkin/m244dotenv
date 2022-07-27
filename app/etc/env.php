<?php /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */

if (!class_exists(EnvConfig::class)) {

    /**
     * Config data collector from ENV
     */
    class EnvConfig {
        static function getEnvConnectionConfig(?int $i): array
        {
            return [
                'host' => !empty($_ENV["DB_PORT$i"])
                    ? $_ENV["DB_HOST$i"] . ':' . $_ENV["DB_PORT$i"]
                    : $_ENV["DB_HOST$i"],
                'dbname' => $_ENV["DB_DATABASE$i"],
                'username' => $_ENV["DB_USERNAME$i"],
                'password' => $_ENV["DB_PASSWORD$i"],
                'model' => 'mysql4',
                'engine' => 'innodb',
                'initStatements' => 'SET NAMES utf8;',
                'active' => $_ENV["DB_ACTIVE$i"],
                'driver_options' => [
                    1014 => false
                ],
                'profiler' => [
                    'class' => 'Magento\\Framework\\DB\\Profiler',
                    'enabled' => 0,
                ],
            ];
        }
        static function getEnvResourceConfig(?int $i): array
        {
            return [
                'connection' => $_ENV["DB_CONNECTION$i"],
            ];
        }
    }
}

for ($i = 0; $i < 10; $i++) {
    $i = $i > 0 ? $i : null;
    if (isset($_ENV["DB_CONNECTION$i"])) {
        $connection[$_ENV["DB_CONNECTION$i"]] = EnvConfig::getEnvConnectionConfig($i);
        $resource["{$_ENV["DB_CONNECTION$i"]}_setup"] = EnvConfig::getEnvResourceConfig($i);
    }
}

return [
    'backend' => [
        'frontName' => $_ENV['BACKEND_NAME']
    ],
    'remote_storage' => [
        'driver' => 'file'
    ],
    'queue' => [
        'amqp' => [
            'host' => $_ENV['QUEUE_AMQP_HOST'],
            'port' => $_ENV['QUEUE_AMQP_PORT'],
            'user' => $_ENV['QUEUE_AMQP_USERNAME'],
            'password' => $_ENV['QUEUE_AMQP_PASSWORD'],
            'virtualhost' => '/'
        ],
        'consumers_wait_for_messages' => 1
    ],
    'crypt' => [
        'key' => $_ENV['CRYPT_KEY'],
    ],
    'db' => [
        'table_prefix' => $_ENV['DB_TABLE_PREFIX'],
        'connection' => $connection ?? [],
    ],
    'resource' => $resource ?? [],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => $_ENV['MAGE_MODE'],
    'http_cache_hosts' => [
        [
            'host' => 'varnish',
            'port' => '80'
        ]
    ],
    'session' => [
        'save' => 'redis',
        'redis' => [
            'host' => $_ENV['SESSION_REDIS_HOST'],
            'port' => $_ENV['SESSION_REDIS_PORT'],
            'user' => $_ENV['SESSION_REDIS_USERNAME'],
            'password' => $_ENV['SESSION_REDIS_PASSWORD'],
            'timeout' => '2.5',
            'persistent_identifier' => '',
            'database' => '2',
            'compression_threshold' => '2048',
            'compression_library' => 'gzip',
            'log_level' => '1',
            'max_concurrency' => '20',
            'break_after_frontend' => '5',
            'break_after_adminhtml' => '30',
            'first_lifetime' => '600',
            'bot_first_lifetime' => '60',
            'bot_lifetime' => '7200',
            'disable_locking' => '0',
            'min_lifetime' => '60',
            'max_lifetime' => '2592000',
            'sentinel_master' => '',
            'sentinel_servers' => '',
            'sentinel_connect_retries' => '5',
            'sentinel_verify_master' => '0'
        ]
    ],
    'cache' => [
        'frontend' => [
            'default' => [
                'id_prefix' => $_ENV['CACHE_DEFAULT_ID_PREFIX'],
                'backend' => 'Magento\\Framework\\Cache\\Backend\\Redis',
                'backend_options' => [
                    'server' => $_ENV['CACHE_FRONTEND_DEFAULT_HOST'],
                    'database' => '0',
                    'port' => $_ENV['CACHE_FRONTEND_DEFAULT_PORT'],
                    'user' => $_ENV['CACHE_FRONTEND_DEFAULT_USERNAME'],
                    'password' => $_ENV['CACHE_FRONTEND_DEFAULT_PASSWORD'],
                    'compress_data' => '1',
                    'compression_lib' => ''
                ]
            ],
            'page_cache' => [
                'id_prefix' => $_ENV['CACHE_PAGE_ID_PREFIX'],
                'backend' => 'Magento\\Framework\\Cache\\Backend\\Redis',
                'backend_options' => [
                    'server' => $_ENV['CACHE_FRONTEND_PAGE_HOST'],
                    'database' => '1',
                    'port' => $_ENV['CACHE_FRONTEND_PAGE_PORT'],
                    'user' => $_ENV['CACHE_FRONTEND_PAGE_USERNAME'],
                    'password' => $_ENV['CACHE_FRONTEND_PAGE_PASSWORD'],
                    'compress_data' => '0',
                    'compression_lib' => ''
                ]
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
    'cache_types' => [
        'config' => 1,
        'layout' => $_ENV['APP_ENV'] === 'prod',
        'block_html' => $_ENV['APP_ENV'] === 'prod',
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'compiled_config' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'full_page' => $_ENV['APP_ENV'] === 'prod',
        'config_webservice' => 1,
        'translate' => 1
    ],
    'downloadable_domains' => [

    ],
    'install' => [
        'date' => 'Tue, 26 Jul 2022 07:51:15 +0000'
    ],
    'db_logger' => [
        'output' => 'disabled',
        'log_everything' => 1,
        'query_time_threshold' => '0.001',
        'include_stacktrace' => 1
    ],
    'system' => [
        'default' => [
            'web' => [
                'unsecure' => [
                    'base_url' => 'https://app.m244dotenv.test/'
                ],
                'secure' => [
                    'base_url' => 'https://app.m244dotenv.test/',
                    'offloader_header' => 'X-Forwarded-Proto',
                    'use_in_frontend' => '1',
                    'use_in_adminhtml' => '1'
                ],
                'seo' => [
                    'use_rewrites' => '1'
                ]
            ],
            'system' => [
//                'full_page_cache' => [
//                    'caching_application' => '2',
//                    'ttl' => '604800'
//                ]
            ],
            'catalog' => [
                'search' => [
                    'enable_eav_indexer' => '1'
                ]
            ],
            'dev' => [
                'static' => [
                    'sign' => '0'
                ]
            ]
        ]
    ]
];
