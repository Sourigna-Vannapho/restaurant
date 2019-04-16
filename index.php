<?php
require ("vendor/autoload.php");
require ("controller/controller.php");

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
			case "register":
				register();
				break;
			case "guestbook":
				guestbook();
				break;
			case "register_confirm":
				registerConfirm();
				break;
			case "login_confirm":
				loginConfirm();
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