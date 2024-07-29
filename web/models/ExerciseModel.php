<?php

class ExerciseModel{

    static public function createExercise($name, $sets, $reps, $muscleGroup, $day, $id){
        $sql = "INSERT INTO exercises (name, sets, reps, fk_muscle, fk_day, fk_user_id)
                                VALUES (:name, :sets, :reps, :muscleGroup, :day, :id)";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':sets', $sets, PDO::PARAM_STR);
        $stmt->bindParam(':reps', $reps, PDO::PARAM_STR);
        $stmt->bindParam(':muscleGroup', $muscleGroup, PDO::PARAM_INT);
        $stmt->bindParam(':day', $day, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            print_r($stmt->errorInfo());
        }

    }


}



?>