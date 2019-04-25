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

	function uploadPicture(){
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["menuUpload"]["name"]);
		$validUpload = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		if(isset($_POST["submit"])) {
			$checkFile = getimagesize($_FILES["menuUpload"]["tmp_name"]);
			if($checkFile!==false) {

			}else{
				$validUpload = 0;
			}
		}

		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			$validUpload = 0;
		}

		if ($validUpload == 0) {
			return false;
		}else{
			if(move_uploaded_file($_FILES["menuUpload"]["tmp_name"], $target_file)){
			return true;}
			else{
				return false;
			}
		}
	}

}

