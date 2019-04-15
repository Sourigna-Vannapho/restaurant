<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<div class="container-fluid background">
	<div class="image">
		<img src="public/img/bg_menu.jpg" class="img-fluid">
		<div class="blackOverlay"></div>
	</div>
</div>
<div class="container-fluid" id="menuAll">
	<div class="row">
		<div class="col-sm-auto offset-sm-1 menu-item" id="entreeMenu">
			<h2>Entrées</h2>
		</div>
		<div class="col-sm-auto menu-item" id="platMenu">
			<h2>Plats</h2>
		</div>
		<div class="col-sm-auto menu-item" id="dessertMenu">
			<h2>Desserts</h2>
		</div>
		<div class="col-sm-auto menu-item" id="boissonMenu">
			<h2>Boissons</h2>
		</div>
		<div class="col-sm-4 offset-sm-1" id="dailyDish">
			<h2>Plat du jour</h2>
		</div>
	</div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>