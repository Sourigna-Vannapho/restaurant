<?php

namespace model\Sourigna;

class GuestbookManager extends Manager{
	function callGuestbook(){

	}

	function writeGuestbook(){
		$trimmedContent = trim($_POST['comment']);
		if (isset($_SESSION['id'])){
			$userId=$_SESSION['id'];
		}else{$userId=0;}
		if ($trimmedContent !== ''){
			$bdd = $this->databaseConnect();
			$entryGuestbook = $bdd->prepare('INSERT INTO guestbook(content,users_id,date)VALUES(:content,:users_id,NOW())');
			$entryGuestbook->execute(array(
				'content'=>$trimmedContent,
				'users_id'=>$userId));
		}
	}
}