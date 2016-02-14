<?php


require 'vendor/autoload.php';
require 'lib/config/app.config.php';
require_once 'lib/config/api.config.php';

require_once 'lib/core/db.core.php';
require_once 'lib/core/app.core.php';
require_once 'services/guard.service.php';
require_once 'lib/core/app.utils.php';


date_default_timezone_set('Asia/Ho_Chi_Minh');
error_reporting(E_ALL & ~E_NOTICE);
/**-------------------
 * HANDLE ERROR
 *-------------------*/
$c = new Slim\Container(\lib\config\AppConfig::SLIM_CONFIGS);
//$c['errorHandler'] = function ($c) {
//    return function ($request, $response, $exception) use ($c) {
//        return $c['response']->withStatus(500)
//            ->withHeader('Content-Type', 'text/html')
//            ->write('Something went wrong!');
//    };
//};


//register_shutdown_function('fatal_handler');
//
//function fatal_handler()
//{
//    $lastError = error_get_last();
//    if (!is_null($lastError)) {
//        header("HTTP/1.1 500 Internal Server Error");
//    }
//}

$app = new Slim\App($c);

//$c['xcore\AppCore'] = function ($container) {
//    return new AppCore($container);
//};

//$app->add(new AppGuardMiddleware());
require_once __DIR__.'/middlewares/auth.middleware.php';

//$container = $app->getContainer();


// Automatically load router files
$routers = glob('routes/**/*.route.php');
foreach ($routers as $router) {
    require $router;
};

$app->run();
