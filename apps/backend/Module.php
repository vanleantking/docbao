<?php

namespace Apps\Backend;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Db\Adapter\Pdo\Mysql as MySQLAdapter;

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers the module auto-loader
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            [
                'Apps\Backend\Controllers' => __DIR__ . '/controllers/',
                'Apps\Backend\Models' => __DIR__ . '/models/',
                'Apps\Backend\Forms' => __DIR__ . '/forms/',
            ]
        );

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        /**
         * Read configuration
         */
        $config = include __DIR__ . "/config/config.php";

        $di['dispatcher'] = function () {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Apps\Backend\Controllers');
            return $dispatcher;
        };

        /**
         * Setting up the view component
         */
        $di['view'] = function () {

            $view = new View();

            $view->setViewsDir(__DIR__ . '/views/');
            $view->setLayoutsDir('../../common/layouts/');
            $view->setTemplateAfter('main');

            return $view;
        };

        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        // $di['db'] = function () use ($config) {
        //     return new MySQLAdapter(
        //         [
        //             "host" => $config->database->host,
        //             "username" => $config->database->username,
        //             "password" => $config->database->password,
        //             "dbname" => $config->database->name
        //         ]
        //     );
        // };

        //in services.php
        $di->set('config', function () use ($config) {
            return $config;
        }, true);
    }
}
