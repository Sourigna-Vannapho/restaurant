<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<div class="container-fluid background">
	<div class="image">
		<img src="public/img/bg_booking.jpg" class="img-fluid">
		<div class="blackOverlay"></div>
	</div>
</div>
<div class="container" id="bookingForm">
	<h1>Réservation</h1>
	<p>Veuillez remplir les champs ci-dessous</p>
	<p>Pour toute information complémentaire veuillez nous contacter au numéro suivant : 00 00 00 00 00</p>
	<form>
		<div class="form-group">
			<label>Nom</label>
			<input type="text" class="form-control">
		</div>
		<div class="form-group">
			<label>Prénom</label>
			<input type="text" class="form-control">
		</div>
		<div class="form-group">
			<label>Numéro de téléphone</label>
			<input type="tel" name="phone" pattern="[0-9]{10}" class="form-control" placeholder="Exemple : 0123456789">
		</div>
		<div class="form-group">
			<label>Jour de la réservation</label>
			<input type="date" class="form-control">
		</div>
		<div class="form-group">
			<label>Heure de la réservation</label>
			<select class="form-control">
				<option>12:00</option>
				<option>20:00</option>
			</select>
		</div>
		<div class="form-group">
			<label>Nombre de personnes</label>
			<input type="number" min="1" max="10" class="form-control">
			<small class="form-text text-muted">Pour des réservations supérieures à 10 personnes, veuillez nous contacter par téléphone</small>
			<!-- Insérer validation check ? -->
		</div>
		<button type="submit" class="btn btn-primary">Réserver</button>
	</form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>