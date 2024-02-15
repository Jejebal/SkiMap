<?php

/**
 * Project      : SkiMap
 * Description  : Un site web permettant de vérifier les station de ski Suisse.
 * File         : frontend/main.js
 * Authors      : Jérémy Ballanfat
 * Date         : 12 Février 2024
 */

use Slim\Factory\AppFactory;

require_once("../vendor/autoload.php");

require_once("../src/secret.php");

$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);

require_once("../src/route.php");

$app->run();