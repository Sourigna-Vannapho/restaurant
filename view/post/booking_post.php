<?php
if ($bookingStatus == true) {
header('Location:index.php?action=booking&booking_status=false');
}else{
header('Location:index.php?information=booking');}