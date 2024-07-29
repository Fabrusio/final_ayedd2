<?php 

class DaysModel {

	static public function days() {
		$sql = ' 
		SELECT week_days.id_day AS "id_day",
        week_days.day AS "details"
		FROM week_days;
		';
		$stmt = model_sql::connectToDatabase()->prepare($sql);

		if($stmt->execute()) {
	
			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		} else {

			print_r($stmt -> errorInfo());

		}		
		
		$stmt = null;
	
	}

}

?>