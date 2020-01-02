<?php

use Psr\Container\ContainerInterface;
use App\Validation\Validator;

$containerBuilder->addDefinitions([
    'validator' => function (ContainerInterface $c) {
        return new Validator();
    }
]);
