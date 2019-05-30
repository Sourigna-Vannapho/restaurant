<?php 
if ($loginStatus){
	header('Location:index.php?login=fail');
}
else{
	header('Location:index.php?login=success');
}