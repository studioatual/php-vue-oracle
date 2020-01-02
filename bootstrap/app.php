<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$containerBuilder = new ContainerBuilder();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/controllers.php';
require_once __DIR__ . '/render.php';
require_once __DIR__ . '/mail.php';
require_once __DIR__ . '/logs.php';
require_once __DIR__ . '/validator.php';

AppFactory::setContainer($containerBuilder->build());
$app = AppFactory::create();

require_once __DIR__ . '/errors.php';

require_once __DIR__ . '/../routes/api.php';
require_once __DIR__ . '/../routes/web.php';
