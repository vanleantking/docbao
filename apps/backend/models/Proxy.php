<?php
namespace Apps\Backend\Models;
use Phalcon\Mvc\Collection;

class Proxy extends Collection {
	public function initialize()
    {
        $this->setSource('proxy');
    }
}
?>