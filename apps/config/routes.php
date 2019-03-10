<?php
use Phalcon\Mvc\Router;
function myRouters() {
    $router = new Router();

    $router->setDefaultModule('backend');

    $router->add(
        '/login',
        [
            'module'     => 'backend',
            'controller' => 'login',
            'action'     => 'index',
        ]
    );

    $router->add(
        '/admin/products/:action',
        [
            'module'     => 'backend',
            'controller' => 'products',
            'action'     => 1,
        ]
    );

    $router->add(
        '/admin/products/',
        [
            'module'     => 'backend',
            'controller' => 'products',
            'action'     => 'index',
        ]
    );

    $router->add(
        '/products/:action',
        [
            'controller' => 'products',
            'action'     => 1,
        ]
    );

    $router->add(
        '/admin/dictionary/',
        [
            'module'     => 'backend',
            'controller' => 'dictionary',
            'action'     => 'index',
        ]
    );

    return $router;
}
?>