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
        return new App\Controllers\HomeController($app);
    }
);
$app['controllers.users'] = $app->share(
    function () use ($app) {
        return new App\Controllers\UsersController($app);
    }
);
$app['controllers.customers'] = $app->share(
    function () use ($app) {
        return new App\Controllers\CustomersController($app);
    }
);


$app->get('/users', 'controllers.users:listAction')->bind('users_list');
$app->get('/users/new', 'controllers.users:newAction')->bind('users_new');
$app->post('/users/new', 'controllers.users:newAction');
$app->get('/users/{user_key}', 'controllers.users:showAction')->bind('users_show');

$app->get('/customers', 'controllers.customers:listAction')->bind('customers_list');




$app->get('/styleguide', 'controllers.home:styleguideAction')->bind('styleguide');
$app->get('/', 'controllers.home:indexAction')->bind('home');
$app->post('/', 'controllers.home:indexAction');

$app->error(function (\Exception $e, $code) use ($app) {
    if (in_array($code, [202, 404])) {
        return $app['twig']->render('error/404.html.twig', [
            'message' => $e->getMessage()
        ]);
    }
    if ($app['debug']) {
        return;
    }

    return $app['twig']->render('error/500.html.twig', [
        'message' => $e->getMessage()
    ]);
});
