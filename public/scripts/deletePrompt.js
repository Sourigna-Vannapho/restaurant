function userDeleteBookingConfirm(bookingId){
	if(confirm("Désirez vous vraiment supprimer cette réservation ?"))
		{document.getElementById(bookingId).href="index.php?action=user_delete_booking&id=" + bookingId;
	}
};

function deleteBookingConfirm(bookingId){
	if(confirm("Désirez vous vraiment supprimer cette réservation ?"))
		{document.getElementById(bookingId).href="index.php?action=delete_booking&id=" + bookingId;
	}
};
function deleteBlogConfirm(blogId){
	if(confirm("Désirez vous vraiment supprimer cette entrée ?"))
		{document.getElementById(blogId).href="index.php?action=delete_blog&id=" + blogId;
	}
};
function deleteMenuConfirm(dishId){
	if(confirm("Désirez vous vraiment supprimer ce plat ?"))
		{document.getElementById(dishId).href="index.php?action=delete_menu&id=" + dishId;
	}
};