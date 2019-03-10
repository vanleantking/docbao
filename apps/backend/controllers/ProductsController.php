<?php

namespace Apps\Backend\Controllers;
use Apps\Backend\Models\Products;
use Apps\Backend\Controllers\BaseController;

class ProductsController extends BaseController
{
    public function indexAction()
    {
        $this->view->product = Products::findFirst();
    }
}
