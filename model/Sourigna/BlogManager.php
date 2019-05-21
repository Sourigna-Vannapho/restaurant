<?php 

namespace model\Sourigna;

class BlogManager extends Manager{

function callBlog(){
	$bdd = $this->databaseConnect();
	$req = $bdd->query('SELECT id,title,content,DATE_FORMAT(date,\'%d/%m/%Y\') AS date_creation
		FROM blog 
		ORDER BY date DESC
		LIMIT 5');
	return $req;
}

function singleBlog(){
	$bdd = $this->databaseConnect();
	$req = $bdd->prepare('SELECT id,title,content 
		FROM blog
		WHERE id=:id');
	$req->execute(array('id'=>$_GET['id']));
	$singleEntry = $req->fetch();
	return $singleEntry;
}

function writeBlog(){
	$bdd = $this->databaseConnect();
	$req = $bdd->prepare('INSERT INTO blog(title,content,date) VALUES(:title,:content,NOW())');
	$req->execute(array(
		'title'=>$_POST['blogTitle'],
		'content'=>$_POST['blogContent']));
}

function editBlog(){
	$bdd = $this->databaseConnect();
	$req = $bdd->prepare('UPDATE blog 
		SET title = :title, content = :content
		WHERE id = :id');
	$req->execute(array(
		'title'=>$_POST['blogTitle'],
		'content'=>$_POST['blogContent'],
		'id'=>$_GET['id']));
}

function deleteBlog(){
	$bdd = $this->databaseConnect();
	$req = $bdd->prepare('DELETE FROM blog WHERE id = :id');
	$req->execute(array('id'=>$_GET['id']));
}

}