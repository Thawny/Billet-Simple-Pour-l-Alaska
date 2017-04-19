<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

require '../app/routes.php';

$app->run();