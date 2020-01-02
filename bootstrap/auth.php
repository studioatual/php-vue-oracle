<?php

use Psr\Container\ContainerInterface;
use App\Auth\Jwt;
use App\Auth\Auth;

$containerBuilder->addDefinitions([
    'auth' => function (ContainerInterface $c) {
        return new Auth($c);
    },
    'jwt' => function (ContainerInterface $c) {
        $domain = $c->get('settings')['domain'];
        $key = $c->get('settings')['app']['key'];
        return new Jwt($domain, $key);
    }
]);
