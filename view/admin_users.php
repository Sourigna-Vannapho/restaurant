<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<h1> Utilisateurs </h1>
<div class="container">
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
	$userId = $data['id']
?>
		<tr>
			<td><?= $userId ?></td>
			<td><?= $data['username'] ?></td>
			<td><?= $data['last_name'] ?></td>
			<td><?= $data['first_name'] ?></td>
			<td><?= $data['phone'] ?></td>
			<td>
				<select name="userAuthority" form="userForm<?= $userId ?>">
					<option value="1" 
					<?php if ($userAuthority==1)
					{echo 'selected';} 
					?>
					>Client</option>
					<option value="2"
					<?php if ($userAuthority==2)
					{echo 'selected';} 
					?>
					>Employé</option>
					<option value="3"
					<?php if ($userAuthority==3)
					{echo 'selected';} 
					?>
					>Administrateur</option>
				</select>
			</td>
			<td>
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
<?php require('template.php'); ?>