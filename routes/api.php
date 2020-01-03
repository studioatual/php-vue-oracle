<?php

use Slim\Routing\RouteCollectorProxy;
use App\Middlewares\ApiMiddleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->group('/api', function (RouteCollectorProxy $group) use ($app) {

    $group->get('/auth', 'Api.AuthController:index')
        ->setName('api.auth')
        ->add(new ApiMiddleware($app->getContainer()));

    $group->post('/auth', 'Api.AuthController:getLogin')->setName('api.auth.login');

    $group->post('/recover/password', 'Api.AuthController:recoverPassword')->setName('recover.password');

    $group->get('/stock', 'Api.StockController:index')
        ->setName('api.stock')
        ->add(new ApiMiddleware($app->getContainer()));
});

