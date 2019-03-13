<?php
namespace Apps\Backend\Controllers;
use Apps\Backend\Controllers\BaseController;
use ReadFile\ReadFile;
use Apps\Backend\Models\WebConfig;

class WebConfigController extends BaseController {
    public function initialize()
    {
        $this->view->breadcrum = 'Web Config';
        parent::initialize();
    }
	public function indexAction() {
		var_dump('expression');
	}
}
?>