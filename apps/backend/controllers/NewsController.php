<?php
namespace Apps\Backend\Controllers;
use File\ReadFile;
use File\WriteFile;
use Apps\Backend\Controllers\BaseController;
use Apps\Backend\Models\News;
class NewsController extends BaseController {
	public function initialize()
    {
    	$this->order = "_id DESC";
        $this->view->breadcrum = 'News';
        parent::initialize();
    }

    public function indexAction() {
    	$news = News::find(array(
			'condition' => array(
				'created_int'=>-1,
				'status'=> 2
			),
			'sort' => array(
				'created_int'=>1),
			'fields' => array(
				"url" => 1,
			    "title" => 1,
			    "description" => 1,
			    "publish_date" => 1,
			    "keyword" => 1,
			    "publish_date" => 1
			),
			'limit' => 50)		
		);
		$this->view->news = $news;

    }
}
?>