<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<div class="container-fluid background">
	<div class="image">
		<img src="public/img/bg_guestbook.jpg" class="img-fluid">
		<div class="blackOverlay"></div>
	</div>
</div>
<div class="container-fluid" id="guestbook">
	<div>
		<h1>Livre d'or</h1>
		<p>Ceci est un espace où vous pouvez partager vos impressions sur votre visite chez nous !</p>
	</div>
	<form method="POST" action="index.php?action=entry_guestbook">
		<textarea class="form-control col-sm-4 offset-sm-4" name="comment" rows="3"></textarea>
		<br/>
		<button type="submit" class="btn btn-primary">Valider</button>
	</form>
	<?php
	while ($data = $guestbookEntry->fetch()){?>
	<p> <?= ($data['comment']) ?> 
	</p>
	<p> Posté par 
		<?php if ($data['user_id']==0):
			echo ('invité');
	else:
		echo ($data['first_name'] . ' ' . $data['last_name']);
	endif;
		echo (' le ' . $data['creation_date']); ?> 
	</p>
	<?php
	}
	$guestbookEntry->closeCursor();
	?>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>