<?php
namespace Apps\Backend\Controllers;
use ReadFile\ReadFile;
use Apps\Backend\Controllers\BaseController;
use Apps\Backend\Models\Dictionary;

class ProxyController extends BaseController {
	public function __construct() {
		$this->view->breadcrum = 'Proxy Config';
	}

	public function indexAction() {
		ini_set('max_execution_time', 1500);
    	$failed = array();
    	$file_handle = new ReadFile($this->config->proxy['active_proxy']);
    	$file_handle->read();
    	var_dump($file_handle->str);
    	// foreach ($file_handle->buffer as $gram) {
	    // 	$word = new Dictionary();
	    // 	$word->type = $dict;
	    // 	$word->created = date('Y-m-d H:i:s', time());
	    // 	$word->created_int = time();
	    // 	$word->word = $gram;
	    // 	if ($word->save() === false) {
	    // 		$failed[] = $gram;
	    // 	}
    	// }
    	// var_dump($failed);
	}
}

?>