<?php
require ("vendor/autoload.php");
require ("public/php/upload.php");
use model\Sourigna\BlogManager;
use model\Sourigna\UserManager;
use model\Sourigna\GuestbookManager;
use model\Sourigna\BookingManager;
use model\Sourigna\MenuManager;

class Controller{

	function homepage(){
		$blogManager = new BlogManager();
		$blogRead = $blogManager->callBlog();
		require('view/homepage.php');
	}

	function menu(){
		$dishPerPage = 8;
		$menuManager = new MenuManager();
		$menuStatus = $menuManager->callMenu($dishPerPage);
		// Calculates the maximum amount of pages
		$menuPageNb = $menuManager->callPaginationTotalMenu($dishPerPage);
		require('view/menu.php');
	}

	function booking(){
		require('view/booking.php');
	}

	function register(){
		require('view/register.php');
	}

	function registerConfirm(){
		$userManager = new UserManager();
		// Creates an account with no authority
		$registerStatus = $userManager->callRegister();
		require('view/post/register_post.php');
	}

	function userPromote(){
		$userManager = new UserManager();
		// Retrieves authentication string generated to compare it
		$stringRetrieve = $userManager->callAuthentication();
		// Increase authority to 1
		$promoteStatus = $userManager->callPromote($stringRetrieve);
		require('view/post/promote_post.php');
	}

	function loginConfirm(){
		$userManager = new UserManager();
		$loginStatus = $userManager->callLogin();
		require('view/post/login_post.php');
	}

	function logoutConfirm(){
		require('view/post/logout_post.php');
	}
	function guestbook(){
		$commentPerPage = 8;
		$guestbookManager = new GuestbookManager();
		$guestbookEntry = $guestbookManager->callGuestbook($commentPerPage);
		// Calculates the maximum amount of pages
		$guestbookPageNb = $guestbookManager->callPaginationTotal($commentPerPage);
		require('view/guestbook.php');
	}
	function entryGuestbook(){
		$guestbookManager = new GuestbookManager();
		$guestbookStatus = $guestbookManager->writeGuestbook();
		require('view/post/guestbook_post.php');
	}
	function bookingConfirm(){
		$bookingManager = new BookingManager();
		$bookingStatus = $bookingManager->callBooking();
		require('view/post/booking_post.php');
	}

	function userProfile(){
		$bookingManager = new BookingManager();
		$userManager = new UserManager();
		$bookingStatus = $bookingManager->userBooking();
		$userStatus = $userManager->userInfo();
		require('view/user_profile.php');
	}

	function userPhone(){
		$userManager = new UserManager();
		$phoneStatus = $userManager->phoneEdit();
		require('view/post/phone_modify_post.php');
	}

	function userPass(){
		$userManager = new UserManager();
		//Retrieves and compare entry of old password with password_verify with current password hash, then updates it to new hashed value
		$passCheck = $userManager->passCheck();
		$passStatus = $userManager->passEdit($passCheck);
		require('view/post/pass_modify_post.php');
	}
	function userBookingDelete(){
		$bookingManager = new BookingManager();
		$bookingStatus = $bookingManager->userBookingDelete();
		require('view/post/user_delete_booking_post.php');
	}

	function adminBooking(){
		$bookingManager = new BookingManager();
		$userManager = new UserManager();
		$bookingStatus = $bookingManager->adminBooking();
		// Deletes any booking prior to today's date
		$deleteBooking = $bookingManager->emptyBooking();
		$userStatus = $userManager->callUsersBooking();
		require('view/admin_booking.php');
	}

	function adminRegister(){
		$userManager = new UserManager();
		// Allows an employee to create an already identified account (authority = 1)
		$userStatus = $userManager->manualUser();
		require('view/post/manual_register_post.php');
	}

	function bookingManual(){
		$bookingManager = new BookingManager();
		$bookingStatus = $bookingManager->manualBooking();
		require('view/post/manual_booking_post.php');
	}

	function bookingDelete(){
		$bookingManager = new BookingManager();
		$bookingStatus = $bookingManager->deleteBooking();
		require('view/post/booking_delete_post.php');
	}

	function adminBlog(){
		$blogManager = new BlogManager();
		$blogRead = $blogManager->callBlog();
		if (isset($_GET['id']))
			{$singleBlogEntry = $blogManager->singleBlog();};
		require('view/admin_blog.php');
	}

	function entryBlog(){
		$blogManager = new BlogManager();
		if (isset($_GET['id'])){
			$editedEntry = $blogManager->editBlog();
		}else{
			$blogEntry = $blogManager->writeBlog();}
		require('view/post/blog_post.php');
	}

	function deleteBlog(){
		$blogManager = new BlogManager();
		$deleteEntry = $blogManager->deleteBlog();
		require('view/post/blog_delete_post.php');
	}

	function adminGuestbook(){
		$guestbookManager = new GuestbookManager();
		$guestbookEntry = $guestbookManager->adminGuestbook();
		require('view/admin_guestbook.php');
	}

	function guestbookDelete(){
		$guestbookManager = new GuestbookManager();
		$guestbookStatus = $guestbookManager->guestbookDelete();
		require('view/post/guestbook_delete_post.php');
	}

	function adminUsers(){
		$userManager = new UserManager();
		$userStatus = $userManager->callUsers();
		require('view/admin_users.php');
	}

	function authorityChange(){
		$userManager = new UserManager();
		$authorityStatus = $userManager->modifyAuthority();
		require('view/post/user_authority_post.php');
	}

	function adminMenu($id){
		$menuManager = new MenuManager();
		$menuDisplay = $menuManager->adminMenu();
		$menuCriteria = $menuManager->callCriteria();
		// Following functions are used to display information about editing dish
		$singleMenuEntry = $menuManager->singleMenu($id);
		$singleCriteriaEntry = $menuManager->singleCriteria($id);
		$nonUsedCriteria = $menuManager->nonPresentCriteria($id);
		require('view/admin_menu.php');
	}

	function adminMenuSingle(){
		$singleMedeletenuEntry = $menuManager->singleMenu();
		$singleCriteriaEntry = $menuManager->singleCriteria();
		$nonUsedCriteria = $menuManager->nonPresentCriteria();
		}
		
	function pictureUpload(){
		$pictureUpload = uploadPicture();
	}

	function newMenu(){
		$menuManager = new MenuManager();
		$newMenu = $menuManager->writeMenu();
		// Retrieves id of newly created dish
		$newestId = $menuManager->getNewId();
		// Renames img_link of dish with the according id
		$updateLink = $menuManager->updateLinkDish($newestId);
		require('view/post/menu_post.php');
	}

	function editMenu(){
		$menuManager = new MenuManager();
		$editMenu = $menuManager->editMenu();
		require('view/post/menu_post.php');
	}

	function newCriteria(){
		$menuManager = new MenuManager();
		$criteriaStatus = $menuManager->insertCriteria();
		require('view/post/criteria_new_post.php');
	}

	function editCriteria(){
		$menuManager = new MenuManager();
		$criteriaStatus = $menuManager->updateCriteria();
		require('view/post/criteria_edit_post.php');
	}

	function removeMenuCriteria(){
		$menuManager = new MenuManager();
		$criteriaStatus = $menuManager->deleteMenuCriteria();
		require('view/post/criteria_edit_post.php');
	}

	function removeCriteria(){
		$menuManager = new MenuManager();
		$criteriaStatus = $menuManager->deleteCriteria();
		require('view/post/criteria_delete_post.php');
	}

	function deleteMenu(){
		$menuManager = new MenuManager();
		$deletePicture = $menuManager->deletePicture();
		$deleteEntry = $menuManager->deleteDish();
		require('view/post/menu_delete_post.php');
	}
}