<?php $title = 'Van\' à pho - Admin - Livre d\'or'; ?>
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
<div class="container">
	<h1>Livre d'or</h1>
	<!-- Displays guestbook entries -->
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
				<?= htmlspecialchars($data['comment']) ?> 
			</td>
			<td>
			<?php if ($data['user_id']==0):
				echo ('Visiteur');
				else:
				echo htmlspecialchars($data['first_name'] . ' ' . $data['last_name']);
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