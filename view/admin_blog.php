<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<div id="blogAdmin" class="container">
	<h1>Blog</h1>
	<form method="POST" action="index.php?action=entry_blog">
		<label>Titre</label>
		<input type="text" class="form-control col" name="blogTitle" required></input>
		<br/>
		<label>Contenu</label>
		<textarea class="form-control col" name="blogContent" rows="3" required></textarea>
		<br/>
		<button type="submit" class="btn btn-primary">Valider</button>
	</form>
	<br/>
	<div>
		<h2>5 dernières entrées</h2>
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
					Posté le <?= ($data['date_creation']) ?>
				</p>
			</div>
		<?php
		}
		$blogRead->closeCursor();
		?>
	</div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>