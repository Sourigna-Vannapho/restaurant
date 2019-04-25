<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<h1>Menu</h1>
<div class="container">
	<a class="btn btn-primary" data-toggle="collapse" href="#collapseBlog" role="button" aria-expanded="false" aria-controls="collapseBlog">
    Afficher éditeur
	</a>
	<br/>
  	<br/>
  	<div class="collapse <?php if(isset($_GET['id'])){echo('show');} ?>" id="collapseBlog">
	  	<div class="card card-body">
	  	<?php 
	  	if (isset($_GET['id'])){
	  	?>
		  	<div class="alert alert-warning" role="alert">
		  		Vous êtes actuellement en train de modifier l'entrée intitulée <?= $singleMenuEntry['name'] ?>
			</div>
		<?php 
		}
		?>
			<form method="POST" action="index.php?action=entry_menu<?php if (isset($_GET['id'])){ echo '&id=' . $singleMenuEntry['id'];}?>" enctype="multipart/form-data">
				<label>Nom</label>
				<input type="text" class="form-control col" name="menuName" value="<?php if (isset($_GET['id'])){ echo $singleMenuEntry['name'];}?>" required></input>
				<br/>
				<label>Description</label>
				<textarea class="form-control col" name="menuDescription" rows="3" required><?php if (isset($_GET['id'])){ echo $singleMenuEntry['description'];}?> </textarea>
				<br/>
				<div class="row">
					<div class="col">
						<label>Catégorie</label>
						<select class="form-control col" name="menuCategory">
							<option value="1" <?php if (isset($_GET['id'])) {if($singleMenuEntry['category']==1){echo('selected');}}?>>Entrée</option>
							<option value="2" <?php if (isset($_GET['id'])) {if($singleMenuEntry['category']==2){echo('selected');}}?> >Plat</option>
							<option value="3" <?php if (isset($_GET['id'])) {if($singleMenuEntry['category']==3){echo('selected');}}?>>Dessert</option>
							<option value="4" <?php if (isset($_GET['id'])) {if($singleMenuEntry['category']==4){echo('selected');}}?>>Boisson</option>
						</select>
					</div>
					<div class="col">
						<label>Prix</label>
						<input type="number" min=0 step="0.01" class="form-control col" name="menuPrice" value="<?php if (isset($_GET['id'])){ echo $singleMenuEntry['price'];} ?>">
					</div>
					<div class="col">
						<label>Disponible</label>
						<select class="form-control col" name="menuAvailable">
							<option value="1" <?php if (isset($_GET['id'])) {if($singleMenuEntry['available']==1){echo('selected');}}?>>Oui</option>
							<option value="0" <?php if (isset($_GET['id'])) {if($singleMenuEntry['available']==0){echo('selected');}}?>>Non</option>
						</select>
					</div>
				</div>
				<input type="file" name="menuUpload" id="menuUpload">
				<button type="submit" name="submit" class="btn btn-primary"><?php if (isset($_GET['id'])){ echo ('Modifier');}else{ echo ('Ajouter');} ?></button>
				<?php
				if (isset($_GET['id'])){
				?>
				<a href="index.php?action=admin_menu"><div class="btn btn-primary">Annuler modification</div></a>
				<?php
				}
				?>
			</form>
		</div>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">Catégorie</th>
				<th scope="col">Nom</th>
				<th scope="col">Description</th>
				<th scope="col">Prix</th>
				<th scope="col">Disponible</th>
				<th scope="col">Image</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
	<?php 
	while ($data = $menuDisplay->fetch()){
		$dishCategory = $data['category'];
		$dishAvailable = $data['available'];
	?>
			<tr>
				<td scope="row">
					<?php 
					switch($dishCategory){
					case 1:
						echo ('Entrée');
						break;
					case 2:
						echo ('Plat');
						break;
					case 3:
						echo ('Dessert');
						break;
					case 4:
						echo ('Boisson');
						break;
					}?></td>
				<td><?= $data['name']?></td>
				<td><?= $data['description']?></td>
				<td><?= $data['price']?> €</td>
				<td><?php if($data['available']==1){echo('Oui');}else{echo('Non');}?></td>
				<td><img src="<?= $data['img_link']?>"></td>
				<td>
					<a href="index.php?action=admin_menu&id=<?=$data['id']?>">Modifier</a>
					<a href="index.php?action=delete_menu&id=<?=$data['id']?>">	Supprimer</a>
				</td>

			</tr>

	<?php	
	}
	$menuDisplay->closeCursor();
	?>
		</tbody>
	</table>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>