<?php
/**
 * Application entry point
 */

use Silex\Provider\RememberMeServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Solution10\Config\Config;

/* Set default timezone */
date_default_timezone_set("Europe/London");

$app['env'] = 'live';
if (isset($app_env) && in_array($app_env, array('dev','unittests','alpha','beta','live'))) {
    $app['env'] = $app_env;
}

// figure out which client we are
$host = $_SERVER['HTTP_HOST'];
$parts = explode('.', $host);

$app['clientName'] = reset($parts);

//
// Build config:
//
$app['config'] = new Config(__DIR__.'/config', ($app['env'] != 'live')? $app['env'] : null);

//
// Register Controller Service Provider
//
$app->register(new ServiceControllerServiceProvider());

//
// Register Session
//
$app->register(new SessionServiceProvider());

//
// Register URL generator
//
$app->register(new UrlGeneratorServiceProvider());

//
// Register security
//

$app->register(new SecurityServiceProvider(), [
    'security.firewalls' => [
        'login' => array(
            'pattern' => '^/login$',
        ),
        'secure' => [
            'pattern' => '^/',
            'anonymous' => false,
            'form' => [
                'login_path' => '/login',
                'check_path' => 'login_check'
            ],
            'logout' => [
                'logout_path' => '/logout'
            ],
            'remember_me' => [
                'key'                => 'Choose_A_Unique_Random_Key',
                'always_remember_me' => true,
            ],
            'users' => $app->share(function() use ($app) {
                $serviceFactory = new \App\Infrastructure\Silex\SilexServiceFactory($app);
                return new \App\Infrastructure\UserAuthUserProvider($serviceFactory);
            }),
        ],
    ],
    'security.encoder.digest' => $app->share(function ($app) {
        return new \App\Infrastructure\PasswordEncoderProvider();
    })
]);

$app->register(new RememberMeServiceProvider());

$app->boot();

//
// Set up Twig
//
$app->register(
    new TwigServiceProvider(),
    [
        'twig.path' => [
            __DIR__.'/views',
            __DIR__.'/src/App/Presenter'
        ],
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
//$logHandlerFactory = new LogHandlerFactory($app['config']->get('logging'));
//$app['log'] = new Logger('app', $logHandlerFactory->getHandlers());


//
// Misc Setup
//
$app['debug'] = $app['config']->get('app.debug', false);
