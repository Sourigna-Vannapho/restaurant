<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<h1>Profil</h1>
<div class="container">
	<h2>Mes infos</h2>
	<div class="container">
		<div class="row">
			Adresse Mail : <?= $userStatus['username']?>
		</div>
		<div class="row">
			<div class="col">
				Nom : <?= $userStatus['first_name']?>
			</div>
			<div class="col">
				Prénom : <?= $userStatus['last_name']?>
			</div>
		</div>
		<div class="row">
			<form method="POST" action="index.php?action=phone_modify">
				<label>Téléphone : </label>
				<input type="tel" name="phone" pattern="[0-9]{10}" value="<?= $userStatus['phone'] ?>" required>
				<button type="submit" class="btn btn-primary" >Modifier</button>
			</form>
		</div>
	</div>
	<h2>Mes réservations</h2>
	<table class="table table-striped">
		<thead>
	      <tr>
	        <th scope="col">Date</th>
	        <th scope="col">Service</th>
	        <th scope="col">Heure</th>
	        <th scope="col">Nombre de personnes</th>
	        <th scope="col"></th>
	      </tr>
    	</thead>
    	<tbody>
    		<?php while ($reservationEntry=$bookingStatus->fetch()){ ?>
    		<tr>
	    		<td scope="row"><?= $reservationEntry['reservationDay'] ?></td>
	    		<td class="
	    		<?php 
	    		if ($reservationEntry['reservation_timeslot']==1): echo ('firstService');
	    		elseif ($reservationEntry['reservation_timeslot']==2): echo ('secondService'); 
	        	endif;
	    		?>"><?php if ($reservationEntry['reservation_timeslot']==1):echo('Midi'); else: echo('Soir'); endif; ?>
	        	</td>
	    		<td><?= $reservationEntry['arrivalTime']?></td>
	    		<td><?= $reservationEntry['client_amount'] ?></td>
	    		<td>
    			<a id='<?= $reservationEntry['id']?>' href ='#' onclick='userDeleteBookingConfirm(<?= $reservationEntry['id']?>)'>Annuler</a>
    			</td>
	    		<?php } ?>
	    		
    		</tr>
    		
    	</tbody>
	</table>

</div>

<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
<script src="public/scripts/deletePrompt.js"></script>
<?php $calledScript = ob_get_clean(); ?>
<?php require('template.php'); ?>