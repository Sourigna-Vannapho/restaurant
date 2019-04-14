<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<div class="container-fluid background">
	<div class="image">
		<img src="public/img/bg_menu.jpg" class="img-fluid">
		<div class="blackOverlay"></div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-1">
			<h2>Entrées</h2>
		</div>
		<div class="col-sm-1">
			<h2>Plats</h2>
		</div>
		<div class="col-sm-1">
			<h2>Desserts</h2>
		</div>
		<div class="col-sm-1">
			<h2>Boissons</h2>
		</div>
	</div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>