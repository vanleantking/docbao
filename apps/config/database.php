<?php
use Phalcon\Di\FactoryDefault;

function setMongoDb() {
	$mongo = new \MongoClient("mongodb://localhost:27017");
    return $mongo->selectDB('docbao');	
}

function collectionManager() {
	return new Phalcon\Mvc\Collection\Manager();
}
?>