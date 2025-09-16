<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use toubilib\api\middlewares\Cors;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ );
$dotenv->load();


$builder = new ContainerBuilder();
$builder->useAutowiring(false);
$builder->addDefinitions(__DIR__ . '/settings.php');
$builder->addDefinitions(__DIR__ . '/services.php');
$builder->addDefinitions(__DIR__ . '/api.php');
$c=$builder->build();
AppFactory::setContainer($c);
$app = AppFactory::create();


$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware($c->get('settings')['displayErrorDetails'], false, false)
    ->getDefaultErrorHandler()
    ->forceContentType('application/json')
;

$app = (require_once __DIR__ . '/routes.php')($app);


return $app;