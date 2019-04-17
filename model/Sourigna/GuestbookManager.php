<?php

namespace model\Sourigna;

class GuestbookManager extends Manager{
	function callGuestbook(){
		$bdd = $this->databaseConnect();
		$comments = $bdd->query('SELECT 
			u.first_name AS first_name,
			u.last_name AS last_name,
			g.content AS comment,
			g.users_id AS user_id,
			DATE_FORMAT(g.date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date
			FROM guestbook g
			LEFT JOIN users u 
			ON g.users_id = u.id
			ORDER BY g.id DESC');
		return $comments;
	}

	function writeGuestbook(){
		$trimmedComment = trim($_POST['comment']);
		if (isset($_SESSION['id'])){
			$userId=$_SESSION['id'];
		}else{$userId=0;}
		if ($trimmedContent !== ''){
			$bdd = $this->databaseConnect();
			$entryGuestbook = $bdd->prepare('INSERT INTO guestbook(content,users_id,date)VALUES(:content,:users_id,NOW())');
			$entryGuestbook->execute(array(
				'content'=>$trimmedComment,
				'users_id'=>$userId));
		}
	}

}