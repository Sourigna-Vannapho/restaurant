<?php $title = 'Van\' à pho - Admin - Réservation'; ?>
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
<h1>Réservations</h1>
<div class="container">
  <a class="btn btn-primary" data-toggle="collapse" href="#collapseRegister" role="button" aria-expanded="false" aria-controls="collapseRegister">
    Inscription Manuelle
  </a>
  <a class="btn btn-primary" data-toggle="collapse" href="#collapseBooking" role="button" aria-expanded="false" aria-controls="collapseBooking">
    Réservation Manuelle
  </a>
  <div class="collapse" id="collapseRegister">
    <div class="card card-body">
      <!-- Form to create a new user with authority of 1 -->
      <form method="POST" action="index.php?action=admin_register" onsubmit="return passwordValidation()">
        <div class="form-group">
          <label>Adresse Mail</label>
          <input type="email" name="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" placeholder="Exemple : adresse@domaine.com" required>
        </div>
        <div class="form-row">
          <div class="col">
            <label>Nom</label>
            <input type="text" class="form-control" name="lastName" required>
          </div>
          <div class="col">
            <label>Prénom</label>
            <input type="text" class="form-control" name="firstName" required>
          </div>
          <div class="col">
            <label>Numéro de téléphone</label>
            <input type="tel" name="phone" pattern="[0-9]{10}" class="form-control" placeholder="Exemple : 0123456789" required>
          </div>
        </div>
        <div class="form-group">
          <label>Mot de passe</label>
          <input type="password" class="form-control" pattern=".{6,}"placeholder="6 caractères minimum" name="pass" id="registerPass" required>
        </div>
        <div class="form-group">
          <label>Confirmation du mot de passe</label>
          <input type="password" class="form-control" id="registerPassConfirm" pattern=".{6,}" name="passConfirm" required>
        </div>
        <br/>
        <button type="submit" class="btn btn-primary" >Inscription</button>
      </form>
    </div>
  </div>
  
  <div class="collapse" id="collapseBooking">
      <div class="card card-body">
        <!-- Form to create a booking with the desired user -->
        <form method="POST" action="index.php?action=manual_booking">
          <div class="form-group">
            <label>Utilisateur</label>
            <select  name="userId" required>
              <?php while ($userList = $userStatus->fetch()){?>
              <option value="<?= $userList['id']?>"><?= $userList['username'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jour de la réservation</label>
            <input type="date" class="form-control" name="day" id="bookingDay" required>
          </div>
          <div class="form-row">
            <div class="col">
              <label>Service</label>
              <select class="form-control" name="timeslot" required>
                <option value="1">Midi</option>
                <option value="2">Soir</option>
              </select>
            </div>
            <div class="col">
              <label>Heure d'arrivée</label>
            <input type="time" name="time" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
            <label>Nombre de personnes</label>
            <input type="number" min="1" max="40" class="form-control" name="nbPpl" required>
          </div>
          <button type="submit" class="btn btn-primary" onclick="return validateDate('<?= date('Y-m-d') ?>')">Réserver</button>

        </form>
    </div>
  </div>
  <!-- Displays all the bookings for the following 2 days -->
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Service</th>
        <th scope="col">Heure</th>
        <th scope="col">Nom</th>
        <th scope="col">Nombre de personnes</th>
        <th scope="col">Numéro de téléphone</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
    	<?php 
      //Sets a timezone to avoid any discrepancies
    	date_default_timezone_set('Europe/Paris');
      //Sets days values for class and calculate the amount of tables
    	$today = date('d/m/Y');
    	$tomorrow = date('d/m/Y',strtotime("+1 day"));
    	$afterTomorrow = date('d/m/Y',strtotime("+2 day"));
      $tableTodayLunch = 0;
      $tableTodayDinner = 0;
      $tableTmwLunch = 0;
      $tableTmwDinner = 0;
      $tableATmwLunch = 0;
      $tableATmwDinner = 0;

    	while ($reservationEntry=$bookingStatus->fetch()){ 
   	?>
    	<tr>
    		<td scope="row" class="
    		<?php 
    		if ($reservationEntry['reservationDay']==$today): echo ('todayDate');
    		elseif($reservationEntry['reservationDay']==$tomorrow): echo ('tomorrowDate');
    		elseif($reservationEntry['reservationDay']==$afterTomorrow): echo ('afterTomorrowDate');
        endif;?>"><?= $reservationEntry['reservationDay'] ?></td>
    		<td class="
    		<?php 
    		if ($reservationEntry['reservationTime']==1): echo ('firstService');
    		elseif ($reservationEntry['reservationTime']==2): echo ('secondService'); 
        endif;
    		?>"><?php if ($reservationEntry['reservationTime']==1):echo('Midi'); else: echo('Soir'); endif; ?>
        </td>
    		<td><?= $reservationEntry['arrivalTime']?></td>
    		<td><?= htmlspecialchars($reservationEntry['lastName'] . ' ' .$reservationEntry['firstName']) ?></td>
    		<td><?= $reservationEntry['clientNb'] ?></td>
    		<td><?= $reservationEntry['phone'] ?></td>
        <td><a id='<?= $reservationEntry['reservationId']?>' href ='#' onclick='deleteBookingConfirm(<?= $reservationEntry['reservationId']?>)'>Annuler</a></td>
        
          <?php 
          if($reservationEntry['reservationDay'] == $today){
            if ($reservationEntry['reservationTime']==1){
              $tableTodayLunch =  $tableTodayLunch + $reservationEntry['tableNb'];
            }else{
              $tableTodayDinner =  $tableTodayDinner + $reservationEntry['tableNb'];}
          }
          else if($reservationEntry['reservationDay'] == $tomorrow){
            if ($reservationEntry['reservationTime']==1){
              $tableTmwLunch =  $tableTmwLunch + $reservationEntry['tableNb'];
            }else{
              $tableTmwDinner =  $tableTmwDinner + $reservationEntry['tableNb'];}    
          }
          else if($reservationEntry['reservationDay'] == $afterTomorrow){
            if ($reservationEntry['reservationTime']==1){
              $tableATmwLunch =  $tableATmwLunch + $reservationEntry['tableNb'];
            }else{
              $tableATmwDinner =  $tableATmwDinner + $reservationEntry['tableNb'];}    
          }
        ?>
    	</tr>	
    	<?php
    	} 
    	$bookingStatus->closeCursor();
    	
    	?>
    </tbody>
  </table>
  <!-- Displays the amount of available table for a given timeslot and day -->
  <table class="table">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col" colspan="2"><?= $today ?></th>
        <th scope="col" colspan="2"><?= $tomorrow ?></th>
        <th scope="col" colspan="2"><?= $afterTomorrow ?></th>
      </tr>
      <tr>
        <th scope="col"></th>
        <th scope="col">Midi</th>
        <th scope="col">Soir</th>
        <th scope="col">Midi</th>
        <th scope="col">Soir</th>
        <th scope="col">Midi</th>
        <th scope="col">Soir</th>
      </tr>
    </thead>
    <tbody>
      <td scope="row">Tables Disponibles</td>
      <td><?= 20 - $tableTodayLunch ?></td>
      <td><?= 20 - $tableTodayDinner ?></td>
      <td><?= 20 - $tableTmwLunch ?></td>
      <td><?= 20 - $tableTmwDinner ?></td>
      <td><?= 20 - $tableATmwLunch ?></td>
      <td><?= 20 -$tableATmwDinner ?></td>
    </tbody>
  </table>
</div>
<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
<script src="public/scripts/deletePrompt.js"></script>
<script src="public/scripts/validDate.js"></script>
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