<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<div class="container">
	<h1>Livre d'or</h1>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Commentaire</th>
				<th>Nom</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
	<?php
	while ($data = $guestbookEntry->fetch()){
	?>
	<tr>
		<td class="adminCommentGuestbook">
			<?= ($data['comment']) ?> 
		</td>
		<td>
		<?php if ($data['user_id']==0):
			echo ('Visiteur');
			else:
			echo ($data['first_name'] . ' ' . $data['last_name']);
			endif; ?>
		</td>
		<td>
			<?= $data['creation_date'] ?> 
		</td>
		<td>
			<a id="<?=$data['commentId']?>" href="#" onclick="deleteGuestbookConfirm(<?=$data['commentId']?>)">
			Supprimer
			</a>
		</td>
	</tr>
	<?php
	}
	$guestbookEntry->closeCursor();
	?>
	</table>
</div>
<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
<script src="public/scripts/deletePrompt.js"></script>
<script src="public/scripts/notification.js"></script>
<?php $calledScript = ob_get_clean(); ?>
<?php require('template.php'); ?>