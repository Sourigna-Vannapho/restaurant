<?php 
if ($passStatus==true){
header('Location:index.php?action=user_profile&info=success');}
else{header('Location:index.php?action=user_profile&info=fail');}