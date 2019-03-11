<?php
namespace Apps\Backend\Models;
use Phalcon\Mvc\Collection;
class WebConfig extends Collection {
	public function initialize()
    {
        $this->setSource('web_config');
    }
}
?>