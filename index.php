<?php


require 'vendor/autoload.php';
require_once 'lib/config/AppConfig.php';
require_once 'lib/config/ApiConfig.php';
require_once 'services/ServiceBase.php';

require_once 'lib/core/DB.php';
require_once 'lib/core/AppCore.php';
require_once 'lib/core/Utils.php';
require_once 'lib/core/bootstrap.core.php';
require_once 'lib/core/errorhandler.core.php';


/**-------------------
 * HANDLE ERROR
 *-------------------*/
$c = new Slim\Container(AppConfig::SLIM_CONFIGS);

$c['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        error_log($exception);
        return $c['response']->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write(!AppConfig::IS_DEBUG ? AppConfig::SERVER_ERR_MSG : $exception);
    };
};

$app = new Slim\App($c);

require_once __DIR__ . '/middlewares/auth.middleware.php';


// Automatically load router files
$routers = glob('routes/**/*.route.php');
foreach ($routers as $router) {
    require $router;
};

$app->run();
