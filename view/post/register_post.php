<?php 
if (!$registerStatus){
	header('Location:index.php?register_success=true');
}
else{
	header('Location:index.php?action=register&existing_user=true');
}