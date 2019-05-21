<?php
if(!isset($_SESSION)) 
	{ 
        session_start(); 
    }
require ("controller/controller.php");

try{
	if (isset($_GET['action'])) {
		if ($_GET['action'] == "home"){
			homepage();
		}
		else if ($_GET['action'] == "menu"){
			menu();
		}
		else if ($_GET['action'] == "register"){
			register();
		}
		else if ($_GET['action'] == "guestbook"){
			guestbook();
		}
		else if ($_GET['action'] == "entry_guestbook"){
			entryGuestbook();
		}
		else if ($_GET['action'] == "register_confirm"){
			registerConfirm();
		}
		else if ($_GET['action'] == "login_confirm"){
			loginConfirm();
		}
		else if ($_GET['action'] == "logout"){
			logoutConfirm();
		}
		else if ($_GET['action'] == "register_promote"){
			userPromote();
		}
		else if (isset($_SESSION['authority'])){
			if ($_SESSION['authority'] >= 0){
				if ($_GET['action'] == "user_profile"){
					userProfile();
				}
				else if ($_GET['action'] == "phone_modify"){
					userPhone();
				}
				else if ($_SESSION['authority'] >= 1){
					if ($_GET['action'] == "booking"){
						booking();
					}
					else if ($_GET['action'] == "booking_confirm"){
						bookingConfirm();
					}
					else if ($_GET['action'] == "user_delete_booking"){
						userBookingDelete();
					}
					else if ($_SESSION['authority'] >= 2){
						if ($_GET['action'] == "admin_booking"){
							adminBooking();
						}
						else if ($_GET['action'] == "admin_register"){
							adminRegister();
						}
						else if ($_GET['action'] == "manual_booking"){
							bookingManual();	
						}
						else if ($_GET['action'] == "delete_booking"){
							bookingDelete();
						}
						else if ($_GET['action'] == "admin_blog"){
							adminBlog();
						}
						else if ($_GET['action'] == "entry_blog"){
							entryBlog();
						}
						else if ($_GET['action'] == "delete_blog"){
							deleteBlog();
						}
						else if ($_GET['action'] == "admin_guestbook"){
							adminGuestbook();
						}
						else if ($_GET['action'] == "delete_guestbook"){
							guestbookDelete();
						}
						else if ($_SESSION['authority'] == 3){
							if ($_GET['action'] == "admin_users"){
								adminUsers();
							}
							else if ($_GET['action'] == "authority_modify"){
								authorityChange();
							}
							else if ($_GET['action'] == "admin_menu"){
								if (isset($_GET['id'])){
								adminMenu($_GET['id']);}
								else adminMenu('');
							}
							else if ($_GET['action'] == "entry_menu"){
								if (isset($_FILES['menuUpload']) && $_FILES['menuUpload']['size'] > 0){
								pictureUpload();
								}
								if (isset($_GET['id'])){
								editMenu();
								}else{
								newMenu();
								}
							}
							else if ($_GET['action'] == "new_criteria"){
								newCriteria();
							}
							else if ($_GET['action'] == "edit_criteria"){
								editCriteria();
							}
							else if ($_GET['action'] == "delete_menu_criteria"){
								removeMenuCriteria();
							}
							else if ($_GET['action'] == "delete_criteria"){
								removeCriteria();
							}
							else if ($_GET['action'] == "delete_menu"){
								deleteMenu();
							}
							else{
								homepage();
							}
						}else{
								homepage();
						}
					}else{
						homepage();
					}
				}else{
					homepage();
				}	
			}else{
			homepage();
			}
		}else{
			homepage();
		}
	}else{
		homepage();
	}
}
catch(Exception $e){
	$errorMsg = $e->getMessage();
}