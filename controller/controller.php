<?php
require ("vendor/autoload.php");
use model\Sourigna\BlogManager;
use model\Sourigna\LoginManager;
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
	require('view/menu.php');
}

function booking(){
	require('view/booking.php');
}

function register(){
	require('view/register.php');
}

function registerConfirm(){
	$loginManager = new LoginManager();
	$registerStatus = $loginManager->callRegister();
	require('view/post/register_post.php');
}

function loginConfirm(){
	$loginManager = new LoginManager();
	$loginStatus = $loginManager->callLogin();
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
function adminBooking(){
	$bookingManager = new BookingManager();
	$bookingStatus = $bookingManager->adminBooking();
	require('view/admin_booking.php');
}

function adminBlog(){
	$blogManager = new BlogManager();
	$blogRead = $blogManager->callBlog();
	require('view/admin_blog.php');
}

function entryBlog(){
	$blogManager = new BlogManager();
	$blogEntry = $blogManager->writeBlog();
	require('view/post/blog_post.php');
}