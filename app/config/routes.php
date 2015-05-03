<?php
/**
 * Routes mappings
 */

//
// ---------- Hello Routes -------------
// Setting up a controller through the DI container and then assigning
// routes to it.
//
$app['controllers.home'] = $app->share(
    function () use ($app) {
        return new App\Controllers\HomeController();
    }
);

$app->get('/styleguide', 'controllers.home:styleguideAction')->bind('styleguide');
$app->get('/', 'controllers.home:indexAction')->bind('home');
