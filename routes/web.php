<?php

$app->get('/test', 'Web.TestController:index')->setName('test');
$app->get('[/]', 'Web.HomeController:index')->setName('home');
$app->map(['GET'], '/{routes:.+}', 'Web.HomeController:index');
