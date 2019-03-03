<?php
// use \MongoClient;
use Phalcon\Di\FactoryDefault;

function setMongoDb() {
	$mongo = new \MongoClient("mongodb://localhost:27017");
    return $mongo->selectDB('database');
	
}
?>