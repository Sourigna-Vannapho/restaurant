<?php

namespace model\Sourigna;
use PDO;

class Manager{
	function databaseConnect(){
	$host_name = 'localhost';
	$database = 'restaurant';
	$user_name = 'root';
	$password = '';
	$db = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
	return $db;
	}

}

