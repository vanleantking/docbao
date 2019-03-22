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
		var_dump('expression');
	}

	public function addAction() {
		$this->view->breadcrum = 'Add Config';
		$configform = new WebConfigForm(new WebConfig());

		if ($this->request->isPost()) {
			if ($this->security->checkToken()) {
				$arrPost = $this->request->getPost();
				if ($configform->isValid($arrPost)) {
					var_dump(WebConfig::find(
						[
							[
								'URL' => "https://vnexpress.net/kinh-doanh"
							]
						]
					));exit;
					$webConfig = new WebConfig();
					$webConfig->domain = $arrPost["domain"];
					$webConfig->URL = $arrPost["url"];
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
					// var_dump($webConfig);exit;
				    if ($webConfig->save()) {
				    	$this->flash->success("Add success!");
				    	return $this->response->redirect(ADMIN_URL.'webconfig/index');
				    }
				    $this->flash->error("Add fail!");
				}
			}
		}
		$this->view->form = $configform;
	}

	public function checkConfigExist($data) {
		$url = $this->processURL($data['url']);	

		$isExist = WebConfig::find(
			[
				[
					'url' => $url
				]
			]
		);
	}

	public function processURL($url) {
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
			$url = substr($url, 0, $len_url-2);
		}
	}


}
?>