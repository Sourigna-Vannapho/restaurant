<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<h1>Réservations</h1>
<div class="container">
  
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
    	date_default_timezone_set('Europe/Paris');
    	$today = date('d-m-Y');
    	$tomorrow = date('d-m-Y',strtotime("+1 day"));
    	$afterTomorrow = date('d-m-Y',strtotime("+2 day"));
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
    		<td><?= $reservationEntry['lastName'] . ' ' .$reservationEntry['firstName'] ?></td>
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
      <td><?= $tableTodayLunch ?></td>
      <td><?= $tableTodayDinner ?></td>
      <td><?= $tableTmwLunch ?></td>
      <td><?= $tableTmwDinner ?></td>
      <td><?= $tableATmwLunch ?></td>
      <td><?= $tableATmwDinner ?></td>
    </tbody>
  </table>
</div>
<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
<script src="public/scripts/deletePrompt.js"></script>
<?php $calledScript = ob_get_clean(); ?>
<?php require('template.php'); ?>