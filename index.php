<?php
if(!isset($_SESSION)) 
	{ 
        session_start(); 
    }

require ("controller/controller.php");
$controller = new Controller();

try{
	if (isset($_GET['action'])) {
		// Actions for non identified users
		if ($_GET['action'] == "home"){
			$controller->homepage();
		}
		else if ($_GET['action'] == "menu"){
			$controller->menu();
		}
		else if ($_GET['action'] == "guestbook"){
			$controller->guestbook();
		}
		else if ($_GET['action'] == "entry_guestbook"){
			$controller->entryGuestbook();
		}
		else if ($_GET['action'] == "register"){
			$controller->register();
		}
		else if ($_GET['action'] == "register_confirm"){
			$controller->registerConfirm();
		}
		else if ($_GET['action'] == "login_confirm"){
			$controller->loginConfirm();
		}
		else if ($_GET['action'] == "logout"){
			$controller->logoutConfirm();
		}
		// Action accessed through mail sent when registering using generated authentication string 
		else if ($_GET['action'] == "register_promote"){
			$controller->userPromote();
		}
		else if (isset($_SESSION['authority'])){
			if ($_SESSION['authority'] >= 0){
				// Actions for non-verified users
				if ($_GET['action'] == "user_profile"){
					$controller->userProfile();
				}
				else if ($_GET['action'] == "phone_modify"){
					$controller->userPhone();
				}
				else if ($_GET['action'] == "pass_modify"){
					$controller->userPass();
				}
				else if ($_SESSION['authority'] >= 1){
					// Actions for verified users
					if ($_GET['action'] == "booking"){
						$controller->booking();
					}
					else if ($_GET['action'] == "booking_confirm"){
						$controller->bookingConfirm();
					}
					else if ($_GET['action'] == "user_delete_booking"){
						$controller->userBookingDelete();
					}
					else if ($_SESSION['authority'] >= 2){
						// Actions for employees
						if ($_GET['action'] == "admin_booking"){
							$controller->adminBooking();
						}
						else if ($_GET['action'] == "admin_register"){
							$controller->adminRegister();
						}
						else if ($_GET['action'] == "manual_booking"){
							$controller->bookingManual();	
						}
						else if ($_GET['action'] == "delete_booking"){
							$controller->bookingDelete();
						}
						else if ($_GET['action'] == "admin_blog"){
							$controller->adminBlog();
						}
						else if ($_GET['action'] == "entry_blog"){
							$controller->entryBlog();
						}
						else if ($_GET['action'] == "delete_blog"){
							$controller->deleteBlog();
						}
						else if ($_GET['action'] == "admin_guestbook"){
							$controller->adminGuestbook();
						}
						else if ($_GET['action'] == "delete_guestbook"){
							$controller->guestbookDelete();
						}
						else if ($_SESSION['authority'] == 3){
							// Actions for admins
							if ($_GET['action'] == "admin_users"){
								$controller->adminUsers();
							}
							else if ($_GET['action'] == "authority_modify"){
								$controller->authorityChange();
							}
							else if ($_GET['action'] == "admin_menu"){
								if (isset($_GET['id'])){
								$controller->adminMenu($_GET['id']);}
								else {$controller->adminMenu('');}
							}
							else if ($_GET['action'] == "entry_menu"){
								// Check if a file has been uploaded when editing/creating dish
								if (isset($_FILES['menuUpload']) && $_FILES['menuUpload']['size'] > 0){
								$controller->pictureUpload();
								}
								// Decide if UPDATE or INSERT into database depending on the presence of $_GET['id']
								if (isset($_GET['id'])){
								$controller->editMenu();
								}else{
								$controller->newMenu();
								}
							}
							else if ($_GET['action'] == "new_criteria"){
								$controller->newCriteria();
							}
							else if ($_GET['action'] == "edit_criteria"){
								$controller->editCriteria();
							}
							else if ($_GET['action'] == "delete_menu_criteria"){
								$controller->removeMenuCriteria();
							}
							else if ($_GET['action'] == "delete_criteria"){
								$controller->removeCriteria();
							}
							else if ($_GET['action'] == "delete_menu"){
								$controller->deleteMenu();
							}
							else{
								$controller->homepage();
							}
						}else{
								$controller->homepage();
						}
					}else{
						$controller->homepage();
					}
				}else{
					$controller->homepage();
				}	
			}else{
			$controller->homepage();
			}
		}else{
			$controller->homepage();
		}
	}else{
		$controller->homepage();
	}
}
catch(Exception $e){
	$errorMsg = $e->getMessage();
	$controller->homepage();
}