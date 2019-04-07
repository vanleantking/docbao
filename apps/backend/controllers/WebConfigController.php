<?php
namespace Apps\Backend\Controllers;
use Apps\Backend\Controllers\BaseController;
use ReadFile\ReadFile;
use Apps\Backend\Models\WebConfig;
use Apps\Backend\Forms\WebConfigForm;

class WebConfigController extends BaseController {
    public function initialize()
    {
        $this->view->breadcrum = 'Web Config';
        parent::initialize();
    }
	public function indexAction() {
		$webConfig = WebConfig::find(array(
			'condition' => array(),
			'sort' => array(
				'created_int'=>1),
			'fields' => array(
				"domain" => 1,
				"host_name" => 1,
			    "URL" => 1,
			    "list_news" => 1,
			    "title_news" => 1,
			    "paginate_rexp" => 1,
			    "content_class" => 1,
			    "category_class" => 1,
			    "special_header" => 1,
			    "meta_description" => 1,
			    "meta_keyword" => 1,
			    "category" => 1,
			    "meta" => 1,
			    "comments_class" => 1,
			    "get_comment" => 1
			),
			'limit' => 50)		
		);
		$this->view->webConfig = $webConfig;
	}

	public function addAction() {
		$this->view->breadcrum = 'Add Config';
		$configform = new WebConfigForm(new WebConfig());

		if ($this->request->isPost()) {
			if ($this->security->checkToken()) {
				$arrPost = $this->request->getPost();
				if ($configform->isValid($arrPost)) {
					$isExist = $this->checkConfigExist($arrPost['url']);

					if(!$isExist['is_exist']){
						$webConfig = new WebConfig();
						$webConfig->domain = $arrPost["domain"];
						$webConfig->url = $arrPost["url"];
						$webConfig->validate_url = $isExist['validate_url'];
						$webConfig->list_news = $arrPost["list_news"];
						$webConfig->title_news = $arrPost["title_news"];
						$webConfig->paginate_rexp = $arrPost["paginate_rexp"];
						$webConfig->homepage = isset($arrPost["homepage"]) ? true : false;
						$webConfig->content_class = $arrPost["content_class"];
						$webConfig->category_class = $arrPost["category_class"];
						$webConfig->special_header = isset($arrPost["special_header"]) ? true : false;
						$webConfig->meta_description = $arrPost["meta_description"];
						$webConfig->meta_keyword = $arrPost["meta_keyword"];
						$webConfig->category = $arrPost["category"];
						$webConfig->meta = $arrPost["meta"];
						$webConfig->comments_class = $arrPost["comments_class"];
						$webConfig->get_comment = isset($arrPost["get_comment"]) ? true : false;
						$webConfig->created_int = time();
					    if ($webConfig->save()) {
					    	$this->flash->success("Add success!");
					    	return $this->response->redirect('webconfig/index');
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

	private function checkConfigExist($data) {
		$url = $this->processURL($data['url']);	
		$isExist = WebConfig::find(
			[
				[

					'validate_url' => $url
				]
			]
		);
		return array(
			'is_exist' => $isExist,
			'validate_url' => $url);
	}

	private function processURL($url) {
		$arr_process = array('https://', 'http://', 'www.', '#');
		foreach ($arr_process as $str) {
			if ($str == "#") {
				$url = preg_split("/#/", $url)[0];
			} else {
				$url = str_replace($str, '', $url);
			}
		}
		$len_url = strlen($url);
		if (substr($url, -1) == "/") {
			$url = substr($url, 0, $len_url-1);
		}

		return $url;
	}
}
?>