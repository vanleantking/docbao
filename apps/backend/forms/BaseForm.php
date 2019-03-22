<?php
namespace Apps\Backend\Forms;
use Phalcon\Forms\Form;

class BaseForm extends Form {
	
	public function messages($name){
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->outputMessage("error", $message);
            }
        }
    }

	/**
    * This method returns the default value for field 'csrf'
    */
    // public function getCsrf()
    // {
    //     return $this->security->getToken();
    // }

    // public function getCsrfKey()
    // {
    //     return $this->security->getTokenKey();
    // }
}
?>