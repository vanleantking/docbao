<?php

namespace Apps\Frontend\Controllers;
use Phalcon\Mvc\Controller;

class ProductsController extends Controller
{
    public function indexAction()
    {
        $this->view->product = Products::findFirst();
        var_dump('ccccccccccc');
    }
}
