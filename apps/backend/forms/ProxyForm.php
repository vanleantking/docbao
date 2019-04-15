<?php

namespace Apps\Backend\Forms;
use Apps\Backend\Forms\BaseForm;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Apps\Backend\Models\Proxy;

class ProxyForm extends BaseForm {
	public function initialize(Proxy $proxy, $options = array())
    {
        $proxy_ip = new Text('proxy_ip', array('class'=> 'form-control', 'required' => 'required', 'placeholder' => '192.168.1.68'));
        $proxy_ip->addValidator(new PresenceOf(array(
            'message' => 'IP is required'
        )));

        $proxy_ip->setLabel('Proxy IP');

        $port = new Text('port', array('class'=> 'form-control', 'required' => 'required', 'placeholder' => '8080'));

        $port->addValidator(new PresenceOf(array(
            'message' => 'Port is required'
        )));
        $port->setLabel('Port');

        $schema = new Text('schema', array(
            'class'=> 'form-control',
            'placeholder' => 'http, https...'));
        $schema->setLabel('Schema');

        if (isset($options['edit']) && $options['edit']) {
            $proxy_ip->setDefault($proxy->proxy_ip);
            $port->setDefault($proxy->port);
            $schema->setDefault($proxy->schema);
            $status = new Check('status', array(
                'value' => $proxy->status == 'off' ? false : true,
                'class' => 'switch-button'
            ));
            
        }
        $this->add($proxy_ip);
        $this->add($port);
        $this->add($schema);
    }
}

?>