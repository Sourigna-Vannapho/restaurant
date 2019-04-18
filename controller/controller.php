<?php
require ("vendor/autoload.php");
use model\Sourigna\BlogManager;
use model\Sourigna\LoginManager;
use model\Sourigna\GuestbookManager;
use model\Sourigna\BookingManager;

// use model\Sourigna\Manager;
// $database = new Manager();


function homepage(){
	$blogManager = new BlogManager();
	$blogEntry = $blogManager->callBlog();
	require('view/homepage.php');
}

function menu(){
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
	$guestbookManager = new GuestbookManager();
	$guestbookEntry = $guestbookManager->callGuestbook();
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