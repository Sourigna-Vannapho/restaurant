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
			case "booking":
				booking();
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