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
			$req = $bdd->prepare('INSERT INTO reservation(client_amount,table_amount,reservation_day,reservation_timeslot,users_id,reservation_time)
			VALUES(:client_amount,:table_amount,:reservation_day,:reservation_timeslot,:users_id,:reservation_time)');
			$req->execute(array(
			'client_amount'=>$_POST['nbPpl'],
			'table_amount'=>$tableAmount,
			'reservation_day'=>$_POST['day'],
			'reservation_timeslot'=>$_POST['timeslot'],
			'users_id'=>$_SESSION['id'],
			'reservation_time'=>$_POST['time']));
		}else{
			return true;
		}
	}

	function userBooking(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('SELECT 
			id,
			client_amount, 
			DATE_FORMAT(reservation_day, "%d/%m/%Y") AS reservationDay, 
			reservation_timeslot, 
			TIME_FORMAT(reservation_time, "%H h %i") AS arrivalTime FROM reservation WHERE users_id = :users_id ORDER BY reservationDay ASC');
		$req->execute(array(
			'users_id'=>$_SESSION['id']));
		return $req;
	}

	function userBookingDelete(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('DELETE FROM reservation WHERE id = :id AND users_id = :users_id');
		$req->execute(array(
			'id'=>$_GET['id'],
			'users_id'=>$_SESSION['id']));
		return true;
	}

	function adminBooking(){
		$bdd = $this->databaseConnect();
		$req = $bdd->query('SELECT 
			r.client_amount AS clientNb, 
			r.table_amount AS tableNb, 
			DATE_FORMAT(r.reservation_day, "%d/%m/%Y") AS reservationDay, 
			r.reservation_timeslot AS reservationTime,
			r.id AS reservationId, 
			TIME_FORMAT(r.reservation_time, "%H h %i") AS arrivalTime,
			u.username AS username, 
			u.first_name AS firstName, 
			u.last_name AS lastName, 
			u.phone AS phone
			FROM reservation r
			LEFT JOIN users u ON u.id=r.users_id
			WHERE r.reservation_day  BETWEEN CURDATE() AND CURDATE() + 2
			ORDER BY r.reservation_day ASC,r.reservation_time ASC');
		return $req;
	}

	function emptyBooking(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('DELETE FROM reservation 
			WHERE reservation_day < CURDATE()');
		$req->execute(array());
	}

	function manualBooking($lastUserId){
		$bdd = $this->databaseConnect();
		$tableAmount = round($_POST['nbPpl']/2,0,PHP_ROUND_HALF_UP);
		$maxTableAmount = 20;
		$tableReq = $bdd->prepare('SELECT SUM(table_amount) FROM reservation 
			WHERE reservation_day = :reservation_day AND reservation_timeslot = :reservation_timeslot');
		$tableReq->execute(array(
			'reservation_day'=>$_POST['day'],
			'reservation_timeslot'=>$_POST['timeslot']));
		$availableTable = $tableReq->fetch();
		$tableNb = $availableTable[0];
		if($tableAmount+$tableNb <= $maxTableAmount){
		$req = $bdd->prepare('INSERT INTO reservation(client_amount,table_amount,reservation_day,reservation_timeslot,users_id,reservation_time)
			VALUES(:client_amount,:table_amount,:reservation_day,:reservation_timeslot,:users_id,:reservation_time)');
			$req->execute(array(
			'client_amount'=>$_POST['nbPpl'],
			'table_amount'=>$tableAmount,
			'reservation_day'=>$_POST['day'],
			'reservation_timeslot'=>$_POST['timeslot'],
			'users_id'=>$lastUserId,
			'reservation_time'=>$_POST['time']));
			return 'true';
		}else{
			return 'false';
		}
	}

	function deleteBooking(){
		$bdd = $this->databaseConnect();
		$req = $bdd->prepare('DELETE FROM reservation WHERE id = :id');
		$req->execute(array('id'=>$_GET['id']));
	}
}