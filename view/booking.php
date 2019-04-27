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
	<h2>Rappel de votre profil :</h2>
	<?php 
	if (isset($_SESSION['id'])):
		?>
	Nom : <?= $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?>
	<br/>
	Numéro de téléphone : <?= $_SESSION['phone'] ?>
	<?php
	endif;
	?>

	<form method="POST" action="index.php?action=booking_confirm">
		<div class="form-group">
			<label>Jour de la réservation</label>
			<input type="date" class="form-control" name="day" required>
		</div>
		<div class="form-group">
			<label>Service</label>
			<select class="form-control" name="timeslot" required>
				<option value="1">Midi</option>
				<option value="2">Soir</option>
			</select>
		</div>
		<div class="form-group">
			<label>Heure d'arrivée</label>
			<input type="time" name="time" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Nombre de personnes</label>
			<input type="number" min="1" max="20" class="form-control" name="nbPpl" required>
			<small class="form-text text-muted">Pour des réservations supérieures à 10 personnes, veuillez nous contacter par téléphone</small>
		</div>
		<button type="submit" class="btn btn-primary">Réserver</button>
	</form>
	<?php 
	if (isset($_GET['booking_status'])): 
	?>
			<small class="form-text warning">Nous n'avons malheureusement plus de table disponibles pour ce créneau horaire</small>
	<?php
	endif;
	?>
</div>

<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
<?php $calledScript = ob_get_clean(); ?>
<?php require('template.php'); ?>