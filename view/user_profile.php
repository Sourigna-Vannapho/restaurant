<?php $title = 'Van\' à pho'; ?>
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
		<a class="btn btn-primary" data-toggle="collapse" href="#collapseProfile" role="button" aria-expanded="false" aria-controls="collapseProfile">
	    Modifier mot de passe
	  	</a>
	  	<div class="collapse 
	  	<?php 
	  	if(isset($_GET['info'])):
			if ($_GET['info']=='fail'): echo('show');
			endif;
		endif;
		?>" id="collapseProfile">
	  		<div class="card card-body">
	  			<form method="POST" action="index.php?action=pass_modify" onsubmit="return passwordValidation()">
	  				<label>Mot de passe actuel</label>
	  				<input type="password" class="form-control" pattern=".{6,}" placeholder="6 caractères minimum" name="oldPass" id="oldPass" required>
	  				<?php 
					if(isset($_GET['info'])){ 
					  if ($_GET['info']=='fail'){
					?>
	  				<small class="form-text warning">Mot de passe incorrect</small>
	  				<?php
					  }
					}
					?>
	  				<label>Nouveau mot de passe</label>
	  				<input type="password" class="form-control" pattern=".{6,}" placeholder="6 caractères minimum" name="newPass" id="registerPass" required>
	  				<label>Confirmer mot de passe</label>
	  				<input type="password" class="form-control" pattern=".{6,}" placeholder="6 caractères minimum" name="newPassConfirm" id="registerPassConfirm" required>
	  				<button type="submit" class="btn btn-primary" >Confirmer</button>
	  			</form>
		  	</div>
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
<script src="public/scripts/passwordCheck.js"></script>
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