<?php
namespace Apps\Backend\Controllers;
use Phalcon\Mvc\Controller;

class BaseController extends Controller {
	public function initialize()
    {
        $this->view->setTemplateAfter('admin');
    }
}
?>