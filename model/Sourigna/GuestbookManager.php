<?php

namespace model\Sourigna;

class GuestbookManager extends Manager{
	function callGuestbook($commentPerPage){
		if (isset($_GET['page'])) {
		    $currentPage = $_GET['page'];
		} else {
		    $currentPage = 1;
		}
		$bdd = $this->databaseConnect();
		$offset = ($currentPage - 1) * $commentPerPage;
		$comments = $bdd->query("SELECT 
			u.first_name AS first_name,
			u.last_name AS last_name,
			g.content AS comment,
			g.users_id AS user_id,
			DATE_FORMAT(g.date, '%d/%m/%Y à %Hh%i') AS creation_date
			FROM guestbook g
			LEFT JOIN users u 
			ON g.users_id = u.id
			ORDER BY g.id DESC
			LIMIT $offset, $commentPerPage");
		return $comments;
	}

	function callPaginationTotal($commentPerPage){
		$bdd = $this->databaseConnect();
		$commentNbReq = $bdd->query('SELECT COUNT(*) AS commentNb FROM guestbook');
		$commentNbFetch = $commentNbReq->fetch();
		$commentNb = CEIL($commentNbFetch[0]/$commentPerPage);
		return $commentNb;
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

	function adminGuestbook(){
		$bdd = $this->databaseConnect();
		$comments = $bdd->query("SELECT 
			g.id AS commentId,
			u.first_name AS first_name,
			u.last_name AS last_name,
			g.content AS comment,
			g.users_id AS user_id,
			DATE_FORMAT(g.date, '%d/%m/%Y à %Hh%i') AS creation_date
			FROM guestbook g
			LEFT JOIN users u 
			ON g.users_id = u.id
			ORDER BY g.id DESC");
		return $comments;
	}

	function guestbookDelete(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('DELETE FROM guestbook WHERE id = :id');
		$req->execute(array('id'=>$_GET['id']));
	}

}