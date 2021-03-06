<?php $title = 'Van\' à pho - Inscription'; ?>
<?php ob_start(); ?>
<div class="container-fluid background">
	<div class="image">
		<img src="public/img/bg_register.jpg" class="img-fluid" alt="Register Background">
		<div class="blackOverlay"></div>
	</div>
</div>
<div class="container" id="registerForm">
	<h1>Inscription</h1>
	<!-- Form to let users create their own account -->
	<form method="POST" action="index.php?action=register_confirm" onsubmit="return passwordValidation()">
		<div class="form-group">
			<label>Adresse mail</label>
			<input type="email" name="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" placeholder="Exemple : adresse@domaine.com" required>
			<small class="form-text text-muted">Votre identifiant de connexion sera votre adresse mail</small>
			<?php 
			if (isset($_GET['existing_user'])):
			?>
			<small class="form-text warning">Adresse mail existante dans la base de données</small>
			<?php
			endif;
			?>
		</div>
		<div class="form-group">
			<label>Nom</label>
			<input type="text" class="form-control" name="lastName" required>
		</div>
		<div class="form-group">
			<label>Prénom</label>
			<input type="text" class="form-control" name="firstName" required>
		</div>
		<div class="form-group">
			<label>Numéro de téléphone</label>
			<input type="tel" name="phone" pattern="[0-9]{10}" class="form-control" placeholder="Exemple : 0123456789" required>
		</div>
		<div class="form-group">
			<label>Mot de passe</label>
			<input type="password" class="form-control" pattern=".{6,}" placeholder="6 caractères minimum" name="pass" id="registerPass" required>
		</div>
		<div class="form-group">
			<label>Confirmation du mot de passe</label>
			<input type="password" class="form-control" id="registerPassConfirm" pattern=".{6,}" name="passConfirm" required>
		</div>
		<br/>
		<button type="submit" class="btn btn-primary" >Inscription</button>
	</form>
</div>
<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
<script src="public/scripts/passwordCheck.js"></script>
<?php $calledScript = ob_get_clean(); ?>
<?php require('template.php'); ?>