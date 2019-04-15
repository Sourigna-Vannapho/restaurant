<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<div class="container-fluid background">
	<div class="image">
		<img src="public/img/bg_guestbook.jpg" class="img-fluid">
		<div class="blackOverlay"></div>
	</div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>