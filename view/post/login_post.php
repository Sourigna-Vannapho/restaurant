<?php 
if ($loginStatus){
	header('Location:index.php?login_fail=true');
}
else{
	header('Location:index.php');
}