<?php

$containerBuilder->addDefinitions([
    'settings' => [
        'app' => [
            'name' => getenv('APP_NAME'),
            'key' => getenv('APP_KEY'),
        ],
        'domain' => getenv('APP_URL'),
        'db' => [
            'driver' => getenv('DB_DRIVER'),
            'host' => getenv('DB_HOST'),
            'port' => getenv('DB_PORT'),
            'database' => getenv('DB_DATABASE'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
        ],
        'mail' => [
            'driver' => getenv('MAIL_DRIVER'),
            'host' => getenv('MAIL_HOST'),
            'port' => getenv('MAIL_PORT'),
            'username' => getenv('MAIL_USERNAME'),
            'password' => getenv('MAIL_PASSWORD'),
            'encryption' => getenv('MAIL_ENCRYPTION'),
            'auth' => getenv('MAIL_AUTH') == true ? 'login' : 'plain',
        ]
    ]
]);
