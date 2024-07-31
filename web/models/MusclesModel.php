<?php 

class MusclesModel {

	static public function muscles() {
		$sql = ' 
		SELECT muscle_groups.id_muscle AS "id_muscle",
        muscle_groups.name AS "details"
		FROM muscle_groups;
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