<?php
use \Phalcon\Mvc\Application;
use Phalcon\Session\Adapter\Files;
use Phalcon\Mvc\Url;

require_once '../apps/config/routes.php';
require_once '../apps/config/database.php';
require_once '../apps/config/define.php';

class MyApplication extends Application
{
    public function registerServices() {
        $loader = new \Phalcon\Loader();
        $loader->registerDirs(array(dirname(__DIR__).'/apps/libs/'))->register();
        $di = new \Phalcon\DI\FactoryDefault();
        $di['router'] = myRouters();
        $di->set('mongo', setMongoDb());
        $di->set('collectionManager', collectionManager(), true);
        $di->set('flash', function() {
            $flash = new \Phalcon\Flash\Session([
                'error' => 'alert alert-danger',
                'success' => 'alert alert-success',
                'notice' => 'alert alert-info',
                'warning' => 'alert alert-warning'
            ]);
            return $flash;
        });

        $di->setShared(
            'url',
            function () {
                $url = new Url();
                $url->setBaseUri('http://docbao.local/');
                return $url;
            }
        );

        $di->setShared('session', function () {
            $session = new Files();
            $session->start();
            return $session;
        });
        
        $this->setDI($di);
    }

    public function main() {

        $this->registerServices();
        /**
         * Register application modules
         */
        $this->registerModules(
            [
                'frontend' => [
                    'className' => 'Apps\Frontend\Module',
                    'path'      => '../apps/frontend/Module.php'
                ],
                'backend'  => [
                    'className' => 'Apps\Backend\Module',
                    'path'      => '../apps/backend/Module.php'
                ]
            ]
        );

        echo $this->handle()->getContent();
    }

}

try {
    $application = new MyApplication();

    $application->main();
} catch (Phalcon\Exception $e) {
    echo $e->getMessage();
} catch (PDOException $e) {
    echo $e->getMessage();
}
