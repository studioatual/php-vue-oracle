<?php

use Slim\Views\Twig;
use Psr\Container\ContainerInterface;

$containerBuilder->addDefinitions([
    'view' => function (ContainerInterface $c) {
        return Twig::create(__DIR__ . '/../resources/views', ['cache' => false]);
    }
]);
