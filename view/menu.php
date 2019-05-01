<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<div class="container-fluid background menuAdjust">
	<div class="image">
		<img src="public/img/bg_menu.jpg" class="img-fluid">
		<div class="blackOverlay"></div>
	</div>
</div>
<div class="container-fluid" id="menuAll">
	<div class="row">
		<div class="col-sm-1 menu-item
		<?php 
		if(isset($_GET['category'])):
			if($_GET['category']==1):
			echo ('activeMenu');
			else:echo('nonActiveMenu');
			endif;
		endif;
		?>" id="entreeMenu">
			<a href="index.php?action=menu&category=1&page=1">
				<h2>Entrées</h2>
				<div class="gradientMenu">
					<img src="public/img/entreeMenu.jpg">
					<div class="menuOverlay"></div>	
				</div>
			</a>
		</div>
		<div class="col-sm-1 menu-item
		<?php 
		if(isset($_GET['category'])):
			if($_GET['category']==2):
			echo ('activeMenu');
			else:echo('nonActiveMenu');
			endif;
		endif;
		?>" id="platMenu">
			<a href="index.php?action=menu&category=2&page=1">
				<h2>Plats</h2>
				<div class="gradientMenu">
					<img src="public/img/platMenu.jpg">
					<div class="menuOverlay"></div>
				</div>
					
			</a>
		</div>
		<div class="col-sm-1 menu-item
		<?php 
		if(isset($_GET['category'])):
			if($_GET['category']==3):
			echo ('activeMenu');
			else: echo('nonActiveMenu');endif;
		endif;
		?>" id="dessertMenu">
			<a href="index.php?action=menu&category=3&page=1">
				<div class="gradientMenu">
				<h2>Desserts</h2>
				<img src="public/img/dessertMenu.jpg">
				<div class="menuOverlay"></div>
			</div>
			</a>
		</div>
		<div class="col-sm-1 menu-item
		<?php 
		if(isset($_GET['category'])):
			if($_GET['category']==4):
			echo ('activeMenu');
			else:echo('nonActiveMenu');
			endif;
		endif;
		?>" id="boissonMenu">
			<a href="index.php?action=menu&category=4&page=1">
				<div class="gradientMenu">
				<h2>Boissons</h2>
				<img src="public/img/boissonMenu.jpg">
				<div class="menuOverlay"></div>
			</div>
			</a>
		</div>
		<div class="col-sm-8 container-fluid" id="menuShow">
		<?php 
		$i=0; ?>
			<div class="row">
				<div class="col-sm-6">
					<?php 
					while($data = $menuStatus->fetch()){?>
					<div class="row container-fluid menuEntry">
						<div class="col-sm-auto">
							<img src="<?= $data['img_link'];?>">
						</div>
						<div class="col">
							<div class="row namePrice">
							<span><?= ($data['name']) ?></span>
							<span><?= ($data['price']) . ' €'; ?></span>
							</div>
							<div class="row">
									<?php
								echo($data['description']) . ' '; 
								$i++;?>
							</div>
							<div class="row">
								<a href="#" tabindex="0" data-container="body" data-toggle="popover" data-placement="bottom" data-content="<?= $data['criteria1']?>" >Détails</a>
							</div>
						</div>
					</div>
						<?php
						if ($i==4): ?>
				</div>
				<div class="col-sm-6">
				<?php endif;
					}
					?>
				</div>
			</div>
			<nav>
				<ul class="pagination">
					<?php
				    $p=1;
				    while ($p<=$menuPageNb){ ?>
				    <li class=" page-item <?php if($p == $_GET['page']): echo ('active'); endif;?> "><a class="page-link" href="index.php?action=menu&category=<?= $_GET['category']?>&page=<?= $p ?>"><?= $p ?></a></li>
				    <?php
				    $p++;
					}
				    ?>
				</ul>
			</nav>
		</div>
	</div>
</div>
<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
<?php $calledScript = ob_get_clean(); ?>
<?php require('template.php'); ?>