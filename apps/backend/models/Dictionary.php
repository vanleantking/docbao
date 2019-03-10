<?php
namespace Apps\Backend\Models;
use Phalcon\Mvc\Collection;
class Dictionary extends Collection {
	public function initialize()
    {
        $this->setSource('dictionary');
    }
}
?>