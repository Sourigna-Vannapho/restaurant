<?php 

namespace model\Sourigna;

class BlogManager extends Manager{

function callBlog(){
	$bdd = $this->databaseConnect();
	$req = $bdd->query('SELECT title,content,DATE_FORMAT(date,\'%d/%m/%Y\') AS date_creation
		FROM blog 
		ORDER BY id DESC
		LIMIT 5');
	return $req;
}

function writeBlog(){
	$bdd = $this->databaseConnect();
	$req = $bdd->prepare('INSERT INTO blog(title,content,date) VALUES(:title,:content,NOW())');
	$req->execute(array(
		'title'=>$_POST['blogTitle'],
		'content'=>$_POST['blogContent']));
}

}