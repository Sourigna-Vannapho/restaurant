<?php 

namespace model\Sourigna;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class LoginManager extends Manager{
	function callRegister(){
		$mail = new PHPMailer;
		$trimmedMail = trim($_POST['mail']);
		$trimmedPass = trim($_POST['pass']);
		if ($trimmedMail !== '' && $trimmedPass !== ''){
			$bdd = $this->databaseConnect();
			$mailReq = $bdd->prepare('SELECT username FROM users WHERE username = :mail');
			$mailReq->execute(array('mail'=>$trimmedMail));
			$mailAvailable = $mailReq->fetch();
			if (!$mailAvailable){
				$passHash = password_hash($trimmedPass,PASSWORD_DEFAULT);
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
				// try{
				// 	$mail->setFrom('restaurant.vanapho@gmail.com','Restaurant Van a Pho');
				// 	$mail->addAddress($trimmedMail,trim($_POST['firstName']) . trim($_POST['lastName']));
				// 	$mail->isHTML(TRUE);
				// 	$mail->Subject = 'Van a pho : Confirmation de votre inscription';
				//   	$mail->Body = '<html>Bonjour,<br/> <br/>
				//   	Ce mail est envoyé suite à votre inscription sur le site de notre restaurant Van a Pho, <br/>
				//   	Veuillez cliquer sur le lien ci-dessous afin de finaliser votre inscription : <br/>
				//   	<a href=\'http://restaurant.sourigna-vannapho.com/index.php?action=register_promote&authentication=</html>' . $authenticationGenerate . '<html>\'> http://restaurant.sourigna-vannapho.com/index.php?action=register_promote&authentication= </html>'. $authenticationGenerate . '<html></a><br/>
				//   	Suite à cette vérification vous serez capable de faire des réservations.<br/>

				//   	A bientot chez nous !'
				//   	;
				// 	/* Use SMTP. */
				// 	$mail->isSMTP();
				// 	/* Google (Gmail) SMTP server. */
				// 	$mail->Host = 'smtp.gmail.com';
				// 	/* SMTP port. */
				// 	$mail->Port = 587;
				// 	/* Set authentication. */
				// 	$mail->SMTPAuth = true;
				// 	$mail->SMTPSecure = 'tls';
				// 	/* Username (email address). */
				// 	$mail->Username = 'restaurant.vanapho@gmail.com';
				// 	/* Google account password. */
				// 	$mail->Password = 'Isajab77';
				// 	/* Enable SMTP debug output. */
				//   	$mail->send();}
				//   	catch (Exception $e)
				// 	{
				// 	   echo $e->errorMessage();
				// 	}
				// 	catch (\Exception $e)
				// 	{
				// 	   echo $e->getMessage();
				// 	}
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
