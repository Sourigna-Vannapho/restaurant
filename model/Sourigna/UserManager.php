<?php 

namespace model\Sourigna;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UserManager extends Manager{
	function callRegister(){
		$mail = new PHPMailer;
		$trimmedMail = trim($_POST['mail']);
		$trimmedPass = trim($_POST['pass']);
		if ($trimmedMail !== '' && $trimmedPass !== ''){
			$bdd = $this->databaseConnect();
			// Checks the database to find a match with given username
			$mailReq = $bdd->prepare('SELECT username FROM users WHERE username = :mail');
			$mailReq->execute(array('mail'=>$trimmedMail));
			$mailAvailable = $mailReq->fetch();
			if (!$mailAvailable){
				$passHash = password_hash($trimmedPass,PASSWORD_DEFAULT);
				// Generate random string for user 
				$authenticationGenerate = bin2hex(random_bytes(16));
				$req = $bdd->prepare('INSERT INTO users(username,first_name,last_name,password,authority,phone,authentication_string)
					VALUES(:username,:first_name,:last_name,:password,0,:phone,:authentication)');
				$req->execute(array(
					'username' =>$trimmedMail,
					'first_name' =>trim($_POST['firstName']),
					'last_name'=>trim($_POST['lastName']),
					'password' =>$passHash,
					'phone' => $_POST['phone'],
					'authentication' => $authenticationGenerate
				));
				// Sends mail with associated authentication link and appropriate action to allow user to increase authority to 1
				try{
					// Use SMTP.
					$mail->isSMTP();
					$mail->Host = 'smtp.ionos.fr';
					// SMTP port
					$mail->Port = 25;
					// Set authentication
					$mail->SMTPSecure = 'tls';
					$mail->SMTPAuth = true;
					// Username (email address)
					$mail->Username = 'restaurant@sourigna-vannapho.com';
					// Google account password
					$mail->Password = 'Isajab77!';
					$mail->setFrom('restaurant@sourigna-vannapho.com','Restaurant Van a Pho');
					$mail->addAddress($trimmedMail,trim($_POST['firstName']) . trim($_POST['lastName']));
					$mail->isHTML(TRUE);
					$mail->Subject = 'Van a pho : Confirmation de votre inscription';
				  	$mail->Body = "<html>
				  	Bonjour,<br/> <br/>
				  	Ce mail est envoyé suite à votre inscription sur le site de notre restaurant Van a Pho, <br/>
				  	Veuillez cliquer sur le lien ci-dessous afin de finaliser votre inscription : <br/>
				  	http://restaurant.sourigna-vannapho.com/index.php?action=register_promote&authentication=$authenticationGenerate&mail=$trimmedMail <br/>
				  	Suite à cette vérification vous serez capable de faire des réservations.<br/>

				  	A bientot chez nous !
				  	</html>"
				  	;
					
				  	$mail->send();
				}
				catch (Exception $e)
				{
					echo $e->errorMessage();
				}
			}
			else{
			}
			return $mailAvailable;
		}
		else{
			return true;
		}
	}

	function callAuthentication(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('SELECT authentication_string FROM users WHERE username=:username');
		$req->execute(array('username'=>$_GET['mail']));
		$fetchString = $req->fetch();
		$stringRetrieved = $fetchString[0];
		return $stringRetrieved;
	}

	function callPromote($user_string){
		// Changes authority of user to 1
		if ($user_string == $_GET['authentication']){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('UPDATE users 
			SET authority = 1, authentication_string = :new_string
			WHERE authentication_string = :string');
		$req->execute(array(
			'string'=>$user_string,
			'new_string'=>'Completed'));
		}
		else {
			return false;
		}
	}

	function callLogin(){
		//Check if password matches, if yes, creates $_SESSION
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

	function userInfo(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('SELECT username, first_name, last_name, phone FROM users WHERE id = :id');
		$req->execute(array('id'=>$_SESSION['id']));
		$profile = $req->fetch();
		return $profile;
	}

	function phoneEdit(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('UPDATE users SET phone=:phone WHERE id=:id');
		$req->execute(array(
			'phone'=>$_POST['phone'],
			'id'=>$_SESSION['id']));
		return true;
	}
	function passCheck(){
		//Retrieves current password and compares it to submitted password
		$trimmedPass = trim($_POST['oldPass']);
		if ($trimmedPass !== ''){
		$bdd = $this->databaseConnect();
		$passReq = $bdd->prepare('SELECT password FROM users WHERE id = :id');
		$passReq->execute(array('id'=>$_SESSION['id']));
		$passExisting = $passReq->fetch();
		$passwordCheck = password_verify($_POST['oldPass'],$passExisting['password']);
			if ($passwordCheck){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function passEdit($passCheck){

		if ($passCheck == true){
			$trimmedPass = trim($_POST['newPass']);
			$passHash = password_hash($trimmedPass,PASSWORD_DEFAULT);
			$bdd = $this->databaseConnect();
			$req = $bdd->prepare('UPDATE users SET password=:password WHERE id=:id');
			$req->execute(array(
				'password'=>$passHash,
				'id'=>$_SESSION['id']));
			return true;
		}
		else{
			return false;
		}
	}

	function manualUser(){
		// Creates account with an authority of 1
		$trimmedMail = trim($_POST['mail']);
		$trimmedPass = trim($_POST['pass']);
		if ($trimmedMail !== '' && $trimmedPass !== ''){
			$bdd = $this->databaseConnect();
			$mailReq = $bdd->prepare('SELECT username FROM users WHERE username = :mail');
			$mailReq->execute(array('mail'=>$trimmedMail));
			$mailAvailable = $mailReq->fetch();
			if (!$mailAvailable){
				$passHash = password_hash($trimmedPass,PASSWORD_DEFAULT);
				$req = $bdd->prepare('INSERT INTO users(username,first_name,last_name,password,authority,phone,authentication_string) 
					VALUES(:username,:first_name,:last_name,:password,1,:phone,:authentication_string)');
				$req->execute(array(
					'username'=>$trimmedMail,
					'first_name'=>$_POST['firstName'],
					'last_name'=>$_POST['lastName'],
					'password'=>$passHash,
					'phone'=>$_POST['phone'],
					'authentication_string'=>'Completed'));
		return true;
		}
			else{
			}
			return $mailAvailable;
		}
		else{
			return true;
		}
	}
	function callUsersBooking(){
		$bdd = $this->databaseConnect();
		$req = $bdd->query("SELECT id, username FROM users WHERE authority > 0 ORDER BY username ASC");
		return $req;
	}
	function callUsers(){
		$bdd = $this->databaseConnect();
		$req = $bdd->query("SELECT id, username ,first_name, last_name, authority, phone FROM users ORDER BY username ASC");
		return $req;
	}

	function modifyAuthority(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('UPDATE users 
			SET authority = :authority
			WHERE id = :id');
		$req->execute(array(
			'authority'=>$_POST['userAuthority'],
			'id'=>$_GET['id']));
	}

}
