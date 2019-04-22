<?php
if(!isset($_SESSION)) 
	{ 
        session_start(); 
    }
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
			
		}
		if (isset($_SESSION['authority'])){
			switch($_GET['action']){
				case "booking":
					booking();
					break;
				case "booking_confirm":
					bookingConfirm();
					break;
			}
			if ($_SESSION['authority']==2){
				switch($_GET['action']){
					case "admin_booking":
					adminBooking();
					break;
				}
				switch($_GET['action']){
					case "admin_blog":
					adminBlog();
					break;
				}
				switch($_GET['action']){
					case "entry_blog":
					entryBlog();
					break;
				}
			}
		}
	}
	else{
		homepage();
	}
}
catch(Exception $e){
	$errorMsg = $e->getMessage();
}