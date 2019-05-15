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
			case "register_promote":
				userPromote();
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
				case "user_profile":
					userProfile();
					break;
				case "phone_modify":
					userPhone();
					break;
				case "user_delete_booking":
					userBookingDelete();
					break;
			}
			if ($_SESSION['authority']>=2){
				switch($_GET['action']){
					case "admin_booking":
						adminBooking();
						break;
					case "admin_register":
						adminRegister();
						break;
					case "manual_booking":
						bookingManual();
						break;
					case "delete_booking":
						bookingDelete();
						break;
					case "admin_blog":
						adminBlog();
						break;
					case "entry_blog":
						entryBlog();
						break;
					case "delete_blog":
						deleteBlog();
						break;
				}
			}
			if ($_SESSION['authority']>=3){
				switch($_GET['action']){
					case "admin_users":
						adminUsers();
						break;
					case "authority_modify":
						authorityChange();
						break;
					case "admin_menu":
						adminMenu();
						break;
					case "entry_menu":
					//Check if a new picture has been uploaded
						if (isset($_FILES['menuUpload']) && $_FILES['menuUpload']['size'] > 0){
							pictureUpload();
						}
						//Check if it's an edit or a new entry
						if (isset($_GET['id'])){
							editMenu();
							break;
						}else{
							newMenu();
							break;
						}
					case "new_criteria":
						newCriteria();
						break;
					case "edit_criteria":
						editCriteria();
						break;
					case "delete_menu_criteria":
						removeMenuCriteria();
						break;
					case "delete_criteria":
						removeCriteria();
						break;
					case "delete_menu":
						deleteMenu();
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