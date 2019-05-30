<?php $title = 'Van\' à pho - Accueil'; ?>
<?php ob_start(); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
  integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
  crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
  integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
  crossorigin=""></script>
<div class="container-fluid background" id="homepageBackground">
	<div class="image">
		<img src="public/img/bg_home.jpg" class="img-fluid" alt="Homepage Background">
		<div class="blackOverlay"></div>
	</div>
	<div id="title">
		<h1>Van' à Pho</h1>
		<p>Restaurant traditionnel asiatique</p>
	</div>
	<div id="checkNews">
		<a href="#blog">Voir les dernières nouvelles<br/> <i class="fas fa-chevron-down"></i></a>

	</div>
</div>
<div class="container-fluid" id="homepageDescription">
	<div id= "blog" class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<!--Displays the 5 latest entries -->
				<h2>Dernières Nouvelles</h2>
				<div id="blogSlider" class="row carousel slide" data-ride="carousel">
					<div class="col-sm-10 carousel-inner">
						<?php 
						$i=0;
						while ($data = $blogRead->fetch()){ ?>
						<div class="carousel-item <?php if($i==0):$i=1;
							echo 'active'; endif; ?>">
							<h3>
								<?= htmlspecialchars($data['title']) ?> 
							</h3>
							<p>
								<?= htmlspecialchars($data['content']) ?>
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
					<div id="sliderIndicator">
						<ol class="carousel-indicators">
							<li data-target="#blogSlider" data-slide-to="0" class="active"></li>
						    <li data-target="#blogSlider" data-slide-to="1"></li>
						    <li data-target="#blogSlider" data-slide-to="2"></li>
						    <li data-target="#blogSlider" data-slide-to="3"></li>
						    <li data-target="#blogSlider" data-slide-to="4"></li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="openingHoursMap">
		<div class="col-lg-6">
			<h2>Horaires d'ouverture</h2>
			<table class="table table-striped">
				<tbody>
					<tr>
						<th scope="row">Lundi</th>
						<td>12h00 à 14h00</td>
						<td>19h00 à 21h00</td>
					</tr>
					<tr>
						<th scope="row">Mardi</th>
						<td>12h00 à 14h00</td>
						<td>19h00 à 21h00</td>
					</tr>
					<tr>
						<th scope="row">Mercredi</th>
						<td>12h00 à 14h00</td>
						<td>19h00 à 21h00</td>
					</tr>
					<tr>
						<th scope="row">Jeudi</th>
						<td>12h00 à 14h00</td>
						<td>19h00 à 21h00</td>
					</tr>
					<tr>
						<th scope="row">Vendredi</th>
						<td>12h00 à 14h00</td>
						<td>19h00 à 22h00</td>
					</tr>
					<tr>
						<th scope="row">Samedi</th>
						<td>12h00 à 15h00</td>
						<td>19h00 à 22h00</td>
					</tr>
					<tr>
						<th scope="row">Dimanche</th>
						<td>12h00 à 14h00</td>
						<td>19h00 à 21h00</td>
					</tr>

				</tbody>
			</table>

		</div>
		<div class="col-lg-6">
			<h2>Contact</h2>
			<!--Displays map location of restaurant -->
			<div id="mapid">
				<div class="mapOverlay"></div>			
				<address>
				VAN' A PHO<br/>
				280 Rue Benjamin Delessert<br/>
				77127 Lieusaint<br/>
				01 23 45 67 89<br/>
				Mail : restaurant.vanapho@gmail.com<br/>
				</address>
			</div>

		</div>
	</div>
</div>

<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
<script src="public/scripts/map.js"></script>
<script src="public/scripts/homepage.js"></script>
<?php $calledScript = ob_get_clean(); ?>
<?php require('template.php'); ?>