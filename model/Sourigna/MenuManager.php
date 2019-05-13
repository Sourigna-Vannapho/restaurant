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
		$req = $bdd->prepare("SELECT d.name, d.description, d.price, d.img_link, GROUP_CONCAT(c.libelle) AS libelleGrp
			FROM dishes d
			LEFT JOIN dish_criteria dc ON d.id=dc.dish_id
			LEFT JOIN criteria c ON dc.criteria_id=c.id 
			WHERE category=:category AND available=1
			GROUP BY d.id
			ORDER BY d.id DESC
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

	function adminMenu(){
		$bdd = $this->databaseConnect();
		$req = $bdd->query('SELECT d.id,d.name,d.description,d.price,d.category,d.available,d.img_link, GROUP_CONCAT(c.libelle) AS libelleGrp
			FROM dishes d 
			LEFT JOIN dish_criteria dc ON d.id=dc.dish_id
			LEFT JOIN criteria c ON dc.criteria_id=c.id 
			GROUP BY d.id
			ORDER BY category ASC');
		return $req;
	}

	function callCriteria(){
		$bdd = $this->databaseConnect();
		$req = $bdd->query('SELECT libelle FROM criteria ORDER BY id ASC');
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
	function singleCriteria(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('SELECT c.libelle, c.id
			FROM dish_criteria dc
			INNER JOIN criteria c ON dc.criteria_id=c.id
			WHERE dc.dish_id = :dish_id');
		$req->execute(array('dish_id'=>$_GET['id']));
		return $req;
	}

	function nonPresentCriteria(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('SELECT libelle, id
			FROM criteria 
			WHERE id NOT IN(SELECT criteria_id FROM dish_criteria WHERE dish_id=:dish_id)');
		$req->execute(array('dish_id'=>$_GET['id']));
		return $req;
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
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('INSERT INTO criteria(libelle) VALUES (:libelle)');
		$req->execute(array("libelle"=>$_POST['criteria']));
		return true;
	}

	function updateCriteria(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('INSERT INTO dish_criteria(dish_id,criteria_id) VALUES (:dish_id,:criteria_id)');
		$req->execute(array("dish_id"=>$_GET['id'],
							"criteria_id"=>$_POST['addCriteria']));
		return true;
	}

	function deleteCriteria(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('DELETE FROM dish_criteria WHERE dish_id = :dish_id AND criteria_id = :criteria_id');
		$req->execute(array('dish_id'=>$_GET['id'],
							'criteria_id'=>$_GET['criteria_id']));
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