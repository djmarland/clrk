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
$app['controllers.customers'] = $app->share(
    function () use ($app) {
        return new App\Controllers\CustomersController();
    }
);


$app->get('/customers', 'controllers.customers:listAction')->bind('customers_list');

$app->get('/styleguide', 'controllers.home:styleguideAction')->bind('styleguide');
$app->get('/', 'controllers.home:indexAction')->bind('home');
