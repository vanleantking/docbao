<?php
namespace Apps\Backend\Controllers;
use File\ReadFile;
use File\WriteFile;
use Apps\Backend\Controllers\BaseController;
use Apps\Backend\Models\Proxy;
use Apps\Backend\Forms\ProxyForm;

class ProxyController extends BaseController {
	public function initialize()
    {
    	$this->order = "status DESC";
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

	public function exportJsonAction() {
		$proxies = Proxy::find(array(
			'conditions' => array(
				'status' => true
			),
			'order' => $this->order,
			'fields' => array(
				'_id' => false,
				'proxy_ip' => 1,
				'port' => 1,
				'schema' => 1
			)
		));

		$result = array();
		foreach ($proxies as $proxy) {
			$result['active_proxies'][] = array(
				'proxy_ip' => $proxy->proxy_ip,
				'port' => $proxy->port,
				'schema' => $proxy->schema
			);
		}
		$file_name = DATA . 'active_proxies.json';
		$write = new WriteFile($file_name);
		$write->writeFile(json_encode($result));
		echo "Write file success";

	}

	public function addAction() {
		$this->view->breadcrum = 'Add Proxy';
		$configform = new ProxyForm(new Proxy());

		if ($this->request->isPost()) {
			if ($this->security->checkToken()) {
				$arrPost = $this->request->getPost();
				if ($configform->isValid($arrPost)) {
					$isExist = $this->checkConfigExist($arrPost);

					if(!$isExist['is_exist']){
						$proxy = new Proxy();
						$proxy->proxy_ip = trim($arrPost["proxy_ip"]);
						$proxy->port = trim($arrPost["port"]);
						$proxy->schema = trim($arrPost["schema"]);
						$proxy->status = true;
						$proxy->created = date("Y-m-d H:i:s");
						$proxy->created_int = time();
					    if ($proxy->save()) {
					    	$this->flash->success("Add success!");
					    	return $this->response->redirect('proxy/index');
					    }
					    $this->flash->error("Add fail!");					
					} else {
						$this->flash->error("Config exist");
					}
				}
			}
		}
		$this->view->form = $configform;
	}

	protected function checkConfigExist($data) {
		$isExist = Proxy::find(
			[
				[

					'proxy_ip' => $data["ip"],
					'port' => $data["port"]
				]
			]
		);
		return $isExist;
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