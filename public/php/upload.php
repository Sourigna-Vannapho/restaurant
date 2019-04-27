<?php
function uploadPicture(){
	try{
		$target_dir = "public/uploads/";
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
			throw new Exception('boo');
		}else{
			if(move_uploaded_file($_FILES["menuUpload"]["tmp_name"], $target_file)){
				if (isset($_GET['id'])){
					rename("public/uploads/" . basename( $_FILES["menuUpload"]["name"]),"public/img/". $_GET['id'] .".jpg");
				}
			;}
			else{
				throw new Exception('test');
			}
		}
	}
	catch(Exception $e) {
    	die('Erreur : '.$e->getMessage());
	}

}