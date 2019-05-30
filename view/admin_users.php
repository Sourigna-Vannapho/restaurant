<?php $title = 'Van\' à pho - Admin - Utilisateurs'; ?>
<?php ob_start(); ?>
<?php 
if(isset($_GET['info'])):
  if ($_GET['info']=='success'):
?>
<div id="notification" class="alert alert-success notification" role="alert">
    Opération effectuée avec succès !
</div>
<?php
  endif;
endif;
?>
<h1> Utilisateurs </h1>
<div class="container">
	<!-- Displays every user -->
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">ID</th>
     			<th scope="col">Adresse Mail</th>
      			<th scope="col">Nom</th>
      			<th scope="col">Prénom</th>
      			<th scope="col">Numéro de téléphone</th>
      			<th scope="col">Accès</th>
      			<th scope="col"></th>
      		</tr>
      	</thead>
	<?php
	while ($data = $userStatus->fetch()){
		$userAuthority = $data['authority'];
		$userId = $data['id'];
	?>
		<tr>
			<td><?= $userId ?></td>
			<td><?= htmlspecialchars($data['username']) ?></td>
			<td><?= htmlspecialchars($data['last_name']) ?></td>
			<td><?= htmlspecialchars($data['first_name']) ?></td>
			<td><?= $data['phone'] ?></td>
			<td>
				<select name="userAuthority" form="userForm<?= $userId ?>">
					<option value="0" 
					<?php if ($userAuthority==0):
						echo 'selected'; endif;
					?>
					>Non identifié</option>
					<option value="1" 
					<?php if ($userAuthority==1):
						echo 'selected'; endif;
					?>
					>Client</option>
					<option value="2"
					<?php if ($userAuthority==2):
						echo 'selected'; endif;
					?>
					>Employé</option>
					<option value="3"
					<?php if ($userAuthority==3): 
						echo 'selected'; endif;
					?>
					>Administrateur</option>
				</select>
			</td>
			<td>
				<!-- Form to edit an user authority -->
				<form method="POST" action="index.php?action=authority_modify&id=<?= $data['id'] ?>" id="userForm<?= $userId ?>" >
					<button type="submit" class="btn btn-primary">Modifier Accès</button>
				</form></td>
		</tr>
	<?php
	}
	$userStatus->closeCursor();
	?>
	</table>
</div>
<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
<?php 
if(isset($_GET['info'])):
    if ($_GET['info']=='success'):
?>
<script src="public/scripts/notification.js"></script>
<?php
    endif;
endif;
?>
<?php $calledScript = ob_get_clean(); ?>
<?php require('template.php'); ?>