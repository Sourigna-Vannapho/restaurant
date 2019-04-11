<?php

require('controller/controller.php');

try{
	if (isset($_GET['action'])) {
		if ($_GET['action'] == 'home'){
			homepage();
		}
	}
	else{
		homepage();
	}
}
catch(Exception $e){
	$errorMsg = $e->getMessage();
}