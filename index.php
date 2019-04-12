<?php

require('controller/controller.php');

try{
	if (isset($_GET['action'])) {
		switch($_GET['action']){
			case "home":
				homepage();
				break;
			case "menu":
				menu();
				break;
		}
	}
	else{
		homepage();
	}
}
catch(Exception $e){
	$errorMsg = $e->getMessage();
}