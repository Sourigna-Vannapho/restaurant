<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<div class="container-fluid background">
	<div class="image">
		<img src="public/img/bg_home.jpg" class="img-fluid">
		<div class="blackOverlay"></div>
	</div>
	<div id="title">
		<h1>Van' à Pho</h1>
		<p>Restaurant traditionnel asiatique</p>
	</div>
	<div id="checkNews">
		<a href="#blog">Voir les dernières nouvelles</a>
	</div>
</div>
<div class="container-fluid" id="homepageDescription">
	<div id= "blog" class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<h2>Dernières Nouvelles</h2>
				<div class="row">
					<div class="col-sm-12">
				<!-- Insérer appel vers la base de données pour le blog -->
				Test
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row" id="openingHoursMap">
		<div class="col">
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
		<div class="col">
			<h2>Où nous trouver</h2>

		</div>
	</div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>