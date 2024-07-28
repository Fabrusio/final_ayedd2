<?php 

class GendersModel {

	static public function genders() {
		$sql = ' 
		SELECT genders.id_gender AS "id_gender"
			,genders.gender AS "details"
		FROM genders;
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