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

  	while ($reservationEntry=$bookingStatus->fetch()){ 
 	?>
  	<tr>
  		<td scope="row" class="
  		<?php 
  		if ($reservationEntry['reservationDay']==$today)
  		{echo ('todayDate');}
  		else if($reservationEntry['reservationDay']==$tomorrow)
  		{echo ('tomorrowDate');}
  		else if($reservationEntry['reservationDay']==$afterTomorrow)
  		{echo ('afterTomorrowDate');}?>"><?= $reservationEntry['reservationDay'] ?></td>
  		<td class="
  		<?php 
  		if ($reservationEntry['reservationTime']==1)
  		{echo ('firstService');}
  		else if ($reservationEntry['reservationTime']==2)
  		{echo ('secondService');}
  		?>"><?= $reservationEntry['reservationTime'] ?></td>
  		<td><?= $reservationEntry['arrivalTime']?></td>
  		<td><?= $reservationEntry['lastName'] . ' ' .$reservationEntry['firstName'] ?></td>
  		<td><?= $reservationEntry['clientNb'] ?></td>
  		<td><?= $reservationEntry['phone'] ?></td>
      <td><a href="index.php?action=delete_booking&amp;id=<?= $reservationEntry['reservationId']?>">Annuler</a></td>
  	</tr>	
  	<?php
  	} 
  	$bookingStatus->closeCursor();
  	
  	?>
  </tbody>
</table>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>