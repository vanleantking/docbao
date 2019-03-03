<?php

namespace Apps\Backend\Controllers;
use Phalcon\Mvc\Controller;

class ProductsController extends Controller
{
    public function indexAction()
    {
        $this->view->product = Products::findFirst();
    }
}
