<?php
require "vendor/autoload.php";
use model\Sourigna\BlogManager;
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

function guestbook(){
	require('view/guestbook.php');
}