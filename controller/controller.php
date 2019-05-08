<?php
require ("vendor/autoload.php");
require ("public/php/upload.php");
use model\Sourigna\BlogManager;
use model\Sourigna\UserManager;
use model\Sourigna\GuestbookManager;
use model\Sourigna\BookingManager;
use model\Sourigna\MenuManager;

function homepage(){
	$blogManager = new BlogManager();
	$blogRead = $blogManager->callBlog();
	require('view/homepage.php');
}

function menu(){
	$dishPerPage = 8;
	$menuManager = new MenuManager();
	$menuStatus = $menuManager->callMenu($dishPerPage);
	$menuPageNb = $menuManager->callPaginationTotalMenu($dishPerPage);
	$criteriaStatus = $menuManager->callCriteria();
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
	$registerStatus = $userManager->callRegister();
	require('view/post/register_post.php');
}

function userPromote(){
	$userManager = new UserManager();
	$stringRetrieve = $userManager->callAuthentication();
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

function userBookingDelete(){
	$bookingManager = new BookingManager();
	$bookingStatus = $bookingManager->userBookingDelete();
	require('view/post/user_delete_booking_post.php');
}

function adminBooking(){
	$bookingManager = new BookingManager();
	$userManager = new UserManager();
	$bookingStatus = $bookingManager->adminBooking();
	$deleteBooking = $bookingManager->emptyBooking();
	$deletePlaceholder = $userManager->emptyPlaceholder();
	require('view/admin_booking.php');
}

function bookingManual(){
	$userManager = new UserManager();
	$bookingManager = new BookingManager();
	$userStatus = $userManager->manualUser();	
	$lastUserId = $userManager->getLastUserId();
	$bookingStatus = $bookingManager->manualBooking($lastUserId);
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

function adminMenu(){
	$menuManager = new MenuManager();
	$menuDisplay = $menuManager->adminMenu();
	if (isset($_GET['id']))
		{$singleMenuEntry = $menuManager->singleMenu();}
	require('view/admin_menu.php');
}
function pictureUpload(){
	$pictureUpload = uploadPicture();
}

function newMenu(){
	$menuManager = new MenuManager();
	$newMenu = $menuManager->writeMenu();
	$newestId = $menuManager->getNewId();
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
	require('view/post/criteria_post.php');
}

function editCriteria(){
	$menuManager = new MenuManager();
	$criteriaStatus = $menuManager->updateCriteria();
	require('view/post/criteria_post.php');
}

function deleteMenu(){
	$menuManager = new MenuManager();
	$deletePicture = $menuManager->deletePicture();
	$deleteEntry = $menuManager->deleteDish();
	require('view/post/menu_delete_post.php');
}