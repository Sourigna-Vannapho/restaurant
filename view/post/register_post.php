<?php 
if (!$registerStatus){
	header('Location:index.php?information=register');
}
else{
	header('Location:index.php?action=register&existing_user=true');
}