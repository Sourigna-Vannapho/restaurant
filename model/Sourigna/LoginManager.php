<?php 

namespace model\Sourigna;

class LoginManager extends Manager{
	function callRegister(){
		$trimmedMail = trim($_POST['mail']);
		$trimmedPass = trim($_POST['pass']);
		if ($trimmedMail !== '' && $trimmedPass !== ''){
			$bdd = $this->databaseConnect();
			$mailReq = $bdd->prepare('SELECT username FROM users WHERE username = :mail');
			$mailReq->execute(array('mail'=>$trimmedMail));
			$mailAvailable = $mailReq->fetch();
			if (!$mailAvailable){
				$passHash = password_hash($trimmedPass,PASSWORD_DEFAULT);
				$req = $bdd->prepare('INSERT INTO users(username,first_name,last_name,password,authority,phone)
					VALUES(:username,:first_name,:last_name,:password,0,:phone)');
				$req->execute(array(
					'username' =>$trimmedMail,
					'first_name' =>trim($_POST['firstName']),
					'last_name'=>trim($_POST['lastName']),
					'password' =>$passHash,
					'phone' => $_POST['phone']
				));
			}
			else{
			}
			return $mailAvailable;
		}
		else{
			return true;
		}
	}

	function callLogin(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('SELECT id,username,first_name,last_name,password,authority,phone FROM users WHERE username = :username');
		$req->execute(array(
			'username'=>$_POST['mail']));
		$loginResult = $req->fetch();
		$passwordCheck = password_verify($_POST['password'],$loginResult['password']);
		if(!$loginResult){
			return true;
		}
		else{
			if($passwordCheck){
				session_start();
				$_SESSION['id'] = $loginResult['id'];
				$_SESSION['mail'] = $loginResult['username'];
				$_SESSION['first_name'] = $loginResult['first_name'];
				$_SESSION['last_name'] = $loginResult['last_name'];
				$_SESSION['phone'] = $loginResult['phone'];
				$_SESSION['authority'] = $loginResult['authority'];
			}
			else{
				return true;
			}
		}
	}

}
