<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<?php 
if(isset($_GET['info'])){ 
	if ($_GET['info']=='success'){
?>
<div id="adminAlert" class="alert alert-success notification" role="alert">
  	Opération effectuée avec succès !
</div>
<?php
	}
}
?>
<h1>Menu</h1>
<div class="container">
	<a class="btn btn-primary" data-toggle="collapse" data-target="#collapseMenuEdit" role="button" aria-expanded="false" aria-controls="collapseBlog">
    Editeur Menu
	</a>
	<?php if (isset($_GET['id'])):
	?>
	<a class="btn btn-primary" data-toggle="collapse" data-target="#editCriteria" role="button" aria-expanded="false" aria-controls="collapseBlog">
    Modification critère
	</a>
	<?php 
	endif;
	?>
	<a class="btn btn-primary" data-toggle="collapse" data-target="#newCriteria" role="button" aria-expanded="false" aria-controls="collapseBlog">
    Création critère
	</a>
	<br/>
  	<br/>
  	<div class="collapse <?php 
  	if(isset($_GET['edit'])):
  		if($_GET['edit']=='menu'): echo('show'); 
  		endif; 
  	endif;?>" id="collapseMenuEdit">
	  	<div class="card card-body">
	  	<?php 
	  	if (isset($_GET['id'])):
	  	?>
		  	<div class="alert alert-warning" role="alert">
		  		Vous êtes actuellement en train de modifier l'entrée intitulée <?= $singleMenuEntry['name'] ?>
			</div>
		<?php 
		endif;
		?>
			<form method="POST" action="index.php?action=entry_menu<?php if (isset($_GET['id'])): echo '&id=' . $singleMenuEntry['id']; endif; ?>" enctype="multipart/form-data">
				<label>Nom</label>
				<input type="text" class="form-control col" name="menuName" value="<?php if (isset($_GET['id'])): echo $singleMenuEntry['name']; endif;?>" required></input>
				<br/>
				<label>Description</label>
				<textarea class="form-control col" name="menuDescription" rows="3" required><?php if (isset($_GET['id'])): echo $singleMenuEntry['description']; endif;?> </textarea>
				<br/>
				<div class="row">
					<div class="col">
						<label>Catégorie</label>
						<select class="form-control col" name="menuCategory">
							<option value="1" <?php if (isset($_GET['id'])): if($singleMenuEntry['category']==1): echo('selected'); endif; endif;?>>Entrée</option>
							<option value="2" <?php if (isset($_GET['id'])): if($singleMenuEntry['category']==2): echo('selected');endif;endif;?> >Plat</option>
							<option value="3" <?php if (isset($_GET['id'])): if($singleMenuEntry['category']==3): echo('selected');endif;endif;?>>Dessert</option>
							<option value="4" <?php if (isset($_GET['id'])): if($singleMenuEntry['category']==4): echo('selected');endif;endif;?>>Boisson</option>
						</select>
					</div>
					<div class="col">
						<label>Prix</label>
						<input type="number" min=0 step="0.01" class="form-control col" name="menuPrice" value="<?php if (isset($_GET['id'])): echo $singleMenuEntry['price']; endif; ?>">
					</div>
					<div class="col">
						<label>Disponible</label>
						<select class="form-control col" name="menuAvailable">
							<option value="1" <?php if (isset($_GET['id'])): if($singleMenuEntry['available']==1): echo('selected'); endif;endif;?>>Oui</option>
							<option value="0" <?php if (isset($_GET['id'])): if($singleMenuEntry['available']==0): echo('selected');endif;endif;?>>Non</option>
						</select>
					</div>
				</div>
				<br/>
				<input type="file" name="menuUpload" id="menuUpload" <?php if (!isset($_GET['id'])): echo('required');endif; ?> >
				<br/><br/>
				<button type="submit" name="submit" class="btn btn-primary"><?php if (isset($_GET['id'])): echo ('Modifier'); else: echo ('Ajouter');endif; ?></button>
				<?php
				if (isset($_GET['id'])){
				?>
				<a href="index.php?action=admin_menu"><button class="btn btn-primary">Annuler modification</button></a>
				<?php
				}
				?>
			</form>
		</div>
	</div>
  	<div class="collapse <?php if(isset($_GET['edit'])):
  		if($_GET['edit']=='criteria'): echo('show'); 
  		endif; 
  	endif;?>" id="editCriteria">
  		<?php 
	  	if (isset($_GET['id'])):
	  	?>
		  	<div class="alert alert-warning" role="alert">
		  		Vous êtes actuellement en train de modifier les critères de l'entrée intitulée <?= $singleMenuEntry['name'] ?>
			</div>
  		<table class="table table-striped">
  			<thead>
  				<tr>
	  				<th>
	  				Critères actuels
	  				</th>
	  				<th>
	  				</th>
  				</tr>
  			</thead>
  			<?php while ($singleCriteria = $singleCriteriaEntry->fetch()){
  			?>
  			<tr>
  				<td>
  					<?= $singleCriteria['libelle'] ?>
  				</td>
  				<td>
  					<form method="POST" action="index.php?action=delete_criteria&id=<?= $_GET['id']?>&criteria_id=<?= $singleCriteria['id'] ?>">
  					<button class="btn btn-primary" type="submit">Supprimer</button>
  					</form>
  				</td>
  			<tr>
  			<?php 
  			} 
  			?>
  			<tr>
  				<td>
  					<select name="addCriteria" form="addCriteriaForm">
				  		<?php
				  		while ($criteriaList = $nonUsedCriteria->fetch()){
				  		?>
				  		<option value="<?= $criteriaList['id']?>"><?= $criteriaList['libelle'] ?></option>
				  		<?php
				  		}
				  		$nonUsedCriteria->closeCursor();
				  		?>
			  		</select>
  				</td>
  				<td>
  					<form method="POST" id="addCriteriaForm" action="index.php?action=edit_criteria&id=<?= $_GET['id']?>">
  						<button class="btn btn-primary" type="submit" > Ajouter </button>
  					</form>
  				</td>
  			</tr>
  		</table>
  		<a href="index.php?action=admin_menu" class="btn btn-primary">Terminer modification</a>
  		<?php 
		endif;
		?>
  	</div>
  	<div class="collapse" id="newCriteria">
  		Critères existants : 
  		<select>
	  		<?php
	  		while ($criteria = $menuCriteria->fetch()){
	  		?>
	  		<option><?= $criteria['libelle'] ?></option>
	  		<?php
	  		}
	  		$menuCriteria->closeCursor();
	  		?>
  		</select>
  		<br/><br/>
  		<form method="POST" action="index.php?action=new_criteria">
  			<label>Ajouter : </label>
  			<input type="text" name="criteria" required>
  			<button class="btn btn-primary" type="submit">Confirmer</button>
  		</form>
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
				<td><?= $data['price']?>€</td>
				<td><?php if($data['available']==1): echo('Oui');else: echo('Non');endif;?></td>
				<td><img src="<?= $data['img_link']?>"></td>
				<td>
					<a href="index.php?action=admin_menu&id=<?=$data['id']?>&edit=menu">Modifier</a>
					<a id="<?=$data['id']?>" href="#" onclick="deleteMenuConfirm(<?=$data['id']?>)">	Supprimer</a>
				</td>
			</tr>
			<tr>
				<td colspan="10" scope="row">
					Critères : 
					<?php 
					if ($data['libelleGrp']):
						echo $data['libelleGrp'];
					else:
						echo ('Aucun');
					endif; 
					?>
					<a href="index.php?action=admin_menu&id=<?=$data['id']?>&edit=criteria"><button class="btn btn-primary"> Modifier</button></a>
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
<?php ob_start(); ?>
<script src="public/scripts/deletePrompt.js"></script>
<script src="public/scripts/notification.js"></script>
<?php $calledScript = ob_get_clean(); ?>
<?php require('template.php'); ?>