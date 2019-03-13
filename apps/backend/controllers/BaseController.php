<?php
namespace Apps\Backend\Controllers;
use Phalcon\Mvc\Controller;

class BaseController extends Controller {
	protected $models;
	protected $limit = 50;
	protected $order = '_id ASC';
	public function initialize()
    {
        $this->view->setTemplateAfter('admin');
    }


}
?>