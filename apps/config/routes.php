<?php
use Phalcon\Mvc\Router;
function myRouters() {
    $router = new Router();

    $router->setDefaultModule('backend');

    // $router->add(
    //     '/admin/products/',
    //     [
    //         'module'     => 'backend',
    //         'controller' => 'products',
    //         'action'     => 'index',
    //     ]
    // );

    $router->add("/admin/:controller/:action/:params", array(
        'module' => 'backend',
        'controller' => 1,
        'action' => 2,
        'params' => 3,
    ));

    return $router;
}
?>