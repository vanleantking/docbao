<?php
namespace Apps\Backend\Controllers;
use ReadFile\ReadFile;
use Apps\Backend\Controllers\BaseController;
use Apps\Backend\Models\Dictionary;

class DictionaryController extends BaseController
{

    public function indexAction()
    {
    	ini_set('max_execution_time', 1500);
    	$failed = array();
    	$dicts = array(
    		'bigram' => $this->config->dictionary['bigrams'],
    		'trigram' => $this->config->dictionary['trigrams']
    	);
    	foreach ($dicts as $dict => $path) {
	    	$file_handle = new ReadFile($path);
	    	$file_handle->read();
	    	$file_handle->toArray();
	    	foreach ($file_handle->buffer as $gram) {
		    	$word = new Dictionary();
		    	$word->type = $dict;
		    	$word->created = date('Y-m-d H:i:s', time());
		    	$word->created_int = time();
		    	$word->word = $gram;
		    	if ($word->save() === false) {
		    		$failed[] = $gram;
		    	}
	    	}
    	}
    	var_dump($failed);
    }

    // initial words on mongodb
    // public function saveWordsAction() {
    // 	$dicts = array(
    // 		'bigram' => $this->config->dictionary['bigrams'],
    // 		'trigram' => $this->config->dictionary['trigrams']
    // 	)
    // 	foreach ($dicts as $dict => $path) {
	   //  	$file_handle = new ReadFile($this->config->dictionary['bigrams']);
	   //  	$file_handle->read();
	   //  	$file_handle->toArray();
	   //  	foreach ($file_handle->buffer as $gram) {
		  //   	$word = new Dictionary();
		  //   	$word->type = $dict;
		  //   	$word->created = date('Y-m-d H:i:s a', time());
		  //   	$word->created_int = time();
		  //   	$word->word = $gram;
		  //   	$word->save();
	   //  	}
    // 	}
    // }
}
?>