<?php

namespace Apps\Backend\Controllers;
use Apps\Backend\Controllers\BaseController;

class IndexController extends BaseController
{

	public function initialize()
    {    	
        $this->view->breadcrum = 'Home';
        parent::initialize();
    }

    public function indexAction()
    {
    }
}
