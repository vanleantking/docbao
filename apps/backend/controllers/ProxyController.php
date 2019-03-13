<?php
namespace Apps\Backend\Controllers;
use ReadFile\ReadFile;
use Apps\Backend\Controllers\BaseController;
use Apps\Backend\Models\Proxy;

class ProxyController extends BaseController {
	public function initialize()
    {
        $this->view->breadcrum = 'Proxy Config';
        parent::initialize();
    }

	public function indexAction() {
		$proxies = Proxy::find(array(
			'conditions' => array(),
			'order' => $this->order,
			'limit' => $this->limit
		));

		$this->view->proxies = $proxies;
	}

	public function writeAction() {
		ini_set('max_execution_time', 1500);
    	$failed = array();
    	$file_handle = new ReadFile($this->config->proxy['active_proxy']);
    	$file_handle->read();
    	$active_proxy = json_decode($file_handle->str, true);
    	foreach ($active_proxy['active_proxies'] as $proxy) {
			$config = new Proxy();
    		foreach ($proxy as $key => $value) {
		    	$config->$key = $value;
    		}
    		$config->status = true;
	    	$config->created = date('Y-m-d H:i:s', time());
	    	$config->created_int = time();
	    	if ($config->save() === false) {
	    		$failed[] = $config;
	    	}
    	}
	}
}

?>