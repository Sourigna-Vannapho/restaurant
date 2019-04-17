<?php

namespace model\Sourigna;

class BookingManager extends Manager{

	function callBooking(){
		$tableAmount = round($_POST['nbPpl']/2,0,PHP_ROUND_HALF_UP);
		$maxTableAmount = 20;
		$bdd = $this->databaseConnect();

		$tableReq = $bdd->prepare('SELECT SUM(table_amount) FROM reservation 
			WHERE reservation_day = :reservation_day AND reservation_timeslot = :reservation_timeslot');
		$tableReq->execute(array(
			'reservation_day'=>$_POST['day'],
			'reservation_timeslot'=>$_POST['timeslot']));
		$availableTable = $tableReq->fetch();
		$tableNb = $availableTable[0];
		if($tableAmount+$tableNb <= $maxTableAmount){
			$req = $bdd->prepare('INSERT INTO reservation(client_amount,table_amount,reservation_day,reservation_timeslot,users_id)
			VALUES(:client_amount,:table_amount,:reservation_day,:reservation_timeslot,:users_id)');
			$req->execute(array(
			'client_amount'=>$_POST['nbPpl'],
			'table_amount'=>$tableAmount,
			'reservation_day'=>$_POST['day'],
			'reservation_timeslot'=>$_POST['timeslot'],
			'users_id'=>$_SESSION['id']));
		}else{
			return true;
		}
		
	}
}