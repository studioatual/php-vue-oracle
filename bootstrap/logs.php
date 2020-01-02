<?php

use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$containerBuilder->addDefinitions([
    'logger' => function (ContainerInterface $c) {
        $logger = new Logger($c->get('settings')['app']['name']);
        $filename = date("Ymd").'_'.strtolower(trim($c->get('settings')['app']['name']));
        $file_handler = new StreamHandler(
                __DIR__ . '/../storage/logs/'.$filename.'.log'
            );
        $logger->pushHandler($file_handler);
        return $logger;
    }
]);
