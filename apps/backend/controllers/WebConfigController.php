<?php
namespace Apps\Backend\Controllers;
use Apps\Backend\Controllers\BaseController;
use ReadFile\ReadFile;
use Apps\Backend\Models\WebConfig;

class WebConfigController extends BaseController {
	public function __construct() {
		$this->view->breadcrum = 'Web Config';
	}
	public function indexAction() {
		
	}
}
?>