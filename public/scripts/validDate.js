function validateDate(today){
	if (document.getElementById("bookingDay").value < today ){
	    alert("Veuillez sélectionner une date valide !");
	    return false;
    }else{
    	return true;}
}