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

	function adminBooking(){
		$bdd = $this->databaseConnect();
		$req = $bdd->query('SELECT 
			r.client_amount AS clientNb, 
			r.table_amount AS tableNb, 
			r.reservation_day AS reservationDay, 
			r.reservation_timeslot AS reservationTime,
			r.id AS reservationId, 
			u.username AS username, 
			u.first_name AS firstName, 
			u.last_name AS lastName, 
			u.phone AS phone
			FROM reservation r
			LEFT JOIN users u ON u.id=r.users_id
			WHERE r.reservation_day  BETWEEN CURDATE() AND CURDATE() + 2
			ORDER BY r.reservation_day ASC');
		return $req;
	}

	function deleteBooking(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('DELETE FROM reservation WHERE id = :id');
		$req->execute(array('id'=>$_GET['id']));
	}
}