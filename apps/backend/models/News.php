<?php
namespace Apps\Backend\Models;
use Phalcon\Mvc\Collection;
class News extends Collection {
	public function initialize()
    {
        $this->setSource('news');
    }
}
?>