<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
	<nav class="navbar navbar-expand-sm">
		Panneau Administrateur
	  	<a class="nav-link" href="#">Réservations</a>
		<a class="nav-link" href="#">Blog</a>
	 	<a class="nav-link" href="#">Gérer les accès</a>
	  	<a class="nav-link" href="#">Modifier la carte</a>
	</nav>
	<h1>Réservations</h1>
<div class="container">
<!-- //<?php 
//$today = date('Y-m-d');
//echo $today;
//while ($data = $bookingStatus->fetch()){
//	if($data['reservationDay']==$today){
//		echo $data['phone'];
//	}else {echo ('boo');}
//}
//$bookingStatus->closeCursor();
//?> -->
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Service</th>
      <th scope="col">Heure</th>
      <th scope="col">Nom</th>
      <th scope="col">Nombre de personnes</th>
      <th scope="col">Numéro de téléphone</th>
    </tr>
  </thead>
  <tbody>
  	<?php 
  	date_default_timezone_set('Europe/Paris');
  	$today = date('Y-m-d');
  	$tomorrow = date('Y-m-d',strtotime("+1 day"));
  	$afterTomorrow = date('Y-m-d',strtotime("+2 day"));

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
  		<td></td>
  		<td><?= $reservationEntry['lastName'] . ' ' .$reservationEntry['firstName'] ?></td>
  		<td><?= $reservationEntry['clientNb'] ?></td>
  		<td><?= $reservationEntry['phone'] ?></td>
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