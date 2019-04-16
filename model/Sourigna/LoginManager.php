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

}
