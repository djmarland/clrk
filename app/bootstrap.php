<?php
/**
 * Application entry point
 */

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Monolog\Logger;
use Solution10\Config\Config;
use App\Helpers\LogHandlerFactory;

/* Set default timezone */
date_default_timezone_set("Europe/London");

$app['env'] = 'live';
if (isset($app_env) && in_array($app_env, array('dev','unittests','int','test','live'))) {
    $app['env'] = $app_env;
}

//
// Build config:
//
$app['config'] = new Config(__DIR__.'/config', ($app['env'] != 'live')? $app['env'] : null);

//
// Register Controller Service Provider
//
$app->register(new ServiceControllerServiceProvider());

//
// Set up Twig
//
$app->register(
    new TwigServiceProvider(),
    [
        'twig.path' => __DIR__.'/views',
        'twig.options' => $app['config']->get('twig')
    ]
);
$app['twig']->addExtension(new App\Helpers\AssetHelper($app_name, $app_release_number));
$app['twig']->addFunction(
    new \Twig_SimpleFunction(
        'is_active',
        function ($key) use ($app) {
            return ($app['feature']->isActive($key)) ? true : false;
        }
    )
);

//
// Set up logging
//
$logHandlerFactory = new LogHandlerFactory($app['config']->get('logging'));
$app['log'] = new Logger('app', $logHandlerFactory->getHandlers());


//
// Misc Setup
//
$app['debug'] = $app['config']->get('app.debug', false);
