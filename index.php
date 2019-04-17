<?php
if(!isset($_SESSION)) 
	{ 
        session_start(); 
    }
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
			case "entry_guestbook":
				entryGuestbook();
				break;
			case "register_confirm":
				registerConfirm();
				break;
			case "login_confirm":
				loginConfirm();
				break;
			case "logout":
				logoutConfirm();
				break;
			case "booking_confirm":
				bookingConfirm();
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