function passwordValidation(){
    if (document.getElementById("registerPass").value != document.getElementById("registerPassConfirm").value){
	    alert("Les mots de passe doivent être identiques !");
	    return false;
    }else{
    	return true;}
}