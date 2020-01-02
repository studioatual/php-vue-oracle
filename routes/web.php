<?php

$app->get('/test', 'Web.TestController:index')->setName('test');
$app->get('[/]', 'Web.HomeController:index')->setName('home');
