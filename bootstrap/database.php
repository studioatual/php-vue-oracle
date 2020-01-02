<?php

use Psr\Container\ContainerInterface;

$containerBuilder->addDefinitions([
    'db' => function (ContainerInterface $c) {
        $tns = "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS="
            . "(PROTOCOL=TCP)(HOST=".$c->get('settings')['db']['host'].")"
            . "(PORT=".$c->get('settings')['db']['port'].")))"
            . "(CONNECT_DATA=(SERVER=DEDICATED)"
            . "(SERVICE_NAME=".$c->get('settings')['db']['database'].")))";
        $user = $c->get('settings')['db']['username'];
        $pass = $c->get('settings')['db']['password'];

        $pdo = new PDO("oci:dbname=".$tns, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        return $pdo;
    }
]);
