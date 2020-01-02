<?php

use Psr\Container\ContainerInterface;
use App\Controllers\Api\AuthController;
use App\Controllers\Api\StockController;
use App\Controllers\Web\HomeController;
use App\Controllers\Web\TestController;

$containerBuilder->addDefinitions([
    'Api.AuthController' => function (ContainerInterface $c) {
        return new AuthController($c);
    },
    'Api.StockController' => function (ContainerInterface $c) {
        return new StockController($c);
    },
    'Web.HomeController' => function (ContainerInterface $c) {
        return new HomeController($c);
    },
    'Web.TestController' => function (ContainerInterface $c) {
        return new TestController($c);
    }
]);
