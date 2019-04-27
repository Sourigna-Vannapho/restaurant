<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<div id="blogAdmin" class="container">
	<h1>Blog</h1>
	<br/>
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
		  		Vous êtes actuellement en train de modifier l'entrée intitulée <?= $singleBlogEntry['title'] ?>
			</div>
		<?php 
		}
		?>
			<form method="POST" action="index.php?action=entry_blog<?php if (isset($_GET['id'])){ echo '&id=' . $singleBlogEntry['id'];}?>">
				<label>Titre</label>
				<input type="text" class="form-control col" name="blogTitle" value="<?php if (isset($_GET['id'])){ echo $singleBlogEntry['title'];}?>" required></input>
				<br/>
				<label>Contenu</label>
				<textarea class="form-control col" name="blogContent" rows="3" required><?php if (isset($_GET['id'])){ echo $singleBlogEntry['content'];}?> </textarea>
				<br/>
				<button type="submit" class="btn btn-primary"><?php if (isset($_GET['id'])){ echo ('Modifier');}else{ echo ('Ajouter');} ?></button>
				<?php
				if (isset($_GET['id'])){
				?>
				<a href="index.php?action=admin_blog"><button class="btn btn-primary">Annuler modifications</button></a>
				<?php
				}
				?>
			</form>
		</div>
	</div>
	<br/>
	<br/>
	<div>
		<h2>Les 5 dernières entrées :</h2>
		<?php
		while ($data = $blogRead->fetch()){ ?>
			<div>
				<h3>
					<?= ($data['title']) ?> 
				</h3>
				<p>
					<?= ($data['content']) ?>
				</p>
				<p>
					Posté le <?= ($data['date_creation']) ?> - <a href='index.php?action=admin_blog&amp;id=<?= $data['id']?>'><i class="fas fa-edit"></i>Modifier</a>
					<a id='<?= $data['id']?>' href='index.php?action=delete_blog&amp;id=<?= $data['id']?>'><i class="fas fa-trash-alt"></i>Supprimer</a>
				</p>
			</div>
		<?php
		}
		$blogRead->closeCursor();
		?>
	</div>
</div>
<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
<?php $calledScript = ob_get_clean(); ?>
<?php require('template.php'); ?>