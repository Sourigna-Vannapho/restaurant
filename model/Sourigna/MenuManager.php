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
		$req = $bdd->prepare("SELECT d.name, d.description, d.price, d.img_link
			FROM dishes d
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

	function callCriteria(){
		$bdd = $this->databaseConnect();
		$req = $bdd->query('SELECT dc.*, c.libelle AS criteria
			FROM dish_criteria dc
			INNER JOIN criteria c ON dc.criteria_id = c.id
			LEFT JOIN dishes d ON dc.dish_id = d.id
			WHERE dc.dish_id = d.id');
		return $req;

		// 		$bdd = $this->databaseConnect();
		// $req = $bdd->query('SELECT * FROM disc_criteria 
		// 	INNER JOIN dishes
		// 	ON dish_criteria.dish_id=dishes.id');
		// return $req;
	}

	function adminMenu(){
		$bdd = $this->databaseConnect();
		$req = $bdd->query('SELECT d.id,d.name,d.description,d.price,d.category,d.available,d.img_link, c.*
			FROM dishes d 
			LEFT JOIN dish_criteria c
            ON d.id = c.dish_id
			ORDER BY category ASC');
		return $req;
	}

	function singleMenu(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('SELECT id,name,description,price,category,available,img_link
			FROM dishes WHERE id=:id');
		$req->execute(array('id'=>$_GET['id']));
		$menuEntry = $req->fetch();
		return $menuEntry;
	}

	function writeMenu(){
			$bdd = $this->databaseConnect();
			$firstMenu = $bdd->prepare('INSERT INTO dishes(name,description,price,category,available,img_link) 
				VALUES (:name,:description,:price,:category,:available,:img_link)');
			$firstMenu->execute(array(
				'name'=>$_POST['menuName'],
				'description'=>$_POST['menuDescription'],
				'price'=>$_POST['menuPrice'],
				'category'=>$_POST['menuCategory'],
				'available'=>$_POST['menuAvailable'],
				'img_link'=>'placeholder'));
	}

	function getNewId(){
		$bdd = $this->databaseConnect();
		$idReq = $bdd->query('SELECT MAX(id) FROM dishes');
		$fetchId = $idReq->fetch();
		$latestId = $fetchId[0];
		return $latestId;
	}

	function updateLinkDish($newestId){
		$bdd = $this->databaseConnect();
		$imgLink = "public/img/" . $newestId . "." .strtolower(pathinfo("public/uploads/" . basename($_FILES["menuUpload"]["name"]),PATHINFO_EXTENSION));
		$secondMenu = $bdd->prepare('UPDATE dishes SET img_link = :img_link WHERE id = :id');
		$secondMenu->execute(array(
				'img_link'=>$imgLink,
				'id'=>$newestId));
		rename("public/uploads/" . basename( $_FILES["menuUpload"]["name"]),$imgLink);
		return true;
	}

	function editMenu(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('UPDATE dishes 
			SET name = :name,
				description = :description,
				price = :price,
				category = :category,
				available = :available
			WHERE id = :id');
		$req->execute(array(
			'name'=>$_POST['menuName'],
			'description'=>$_POST['menuDescription'],
			'price'=>$_POST['menuPrice'],
			'category'=>$_POST['menuCategory'],
			'available'=>$_POST['menuAvailable'],
			'id'=>$_GET['id']));
		return true;
	}

	function insertCriteria(){

	}

	function updateCriteria(){

	}

	function deletePicture(){
		$bdd = $this->databaseConnect();
		$imgReq = $bdd->prepare('SELECT img_link FROM dishes WHERE id = :id');
		$imgExec = $imgReq->execute(array('id'=>$_GET['id']));
		$imgFetch = $imgReq->fetch();
		$imgLink = $imgFetch[0];
		unlink($imgLink);
	}

	function deleteDish(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('DELETE FROM dishes WHERE id = :id');
		$req->execute(array('id'=>$_GET['id']));
	}
}