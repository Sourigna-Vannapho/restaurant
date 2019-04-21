<?php 

namespace model\Sourigna;

class MenuManager extends Manager{

	function callMenu($dishPerPage){
		if (isset($_GET['page'])) {
		    $currentPage = $_GET['page'];
		} else {
		    $currentPage = 1;
		}
		$bdd = $this->databaseConnect();
		$offset = ($currentPage - 1) * $dishPerPage;
		$req = $bdd->prepare("SELECT name, description, price, img_link 
			FROM dishes
			WHERE category=:category AND available=1
			ORDER BY id DESC
			LIMIT $offset, $dishPerPage");
		$req->execute(array('category'=>$_GET['category']));
		return $req;
	}

	function callPaginationTotalMenu($dishPerPage){
		$bdd = $this->databaseConnect();
		$dishNbReq = $bdd->prepare('SELECT COUNT(*) AS dishNb FROM dishes WHERE category=:category AND available=1');
		$dishNbReq->execute(array('category'=>$_GET['category']));
		$dishNbReqFetch = $dishNbReq->fetch();
		$dishNb = CEIL($dishNbReqFetch[0]/$dishPerPage);
		return $dishNb;
	}
}