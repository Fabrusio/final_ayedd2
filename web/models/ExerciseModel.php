<?php

class ExerciseModel{

    static public function createExercise($name, $sets, $reps, $muscleGroup, $day, $id, $explanation){
        $sql = "INSERT INTO exercises (name, sets, reps, fk_muscle, fk_day, fk_user_id, explanation)
                                VALUES (:name, :sets, :reps, :muscleGroup, :day, :id, :explanation)";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':sets', $sets, PDO::PARAM_INT);
        $stmt->bindParam(':reps', $reps, PDO::PARAM_INT);
        $stmt->bindParam(':muscleGroup', $muscleGroup, PDO::PARAM_INT);
        $stmt->bindParam(':day', $day, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':explanation', $explanation, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            print_r($stmt->errorInfo());
        }

    }

    static public function getAllExercises($id){
        $sql = "SELECT
        exercises.id_exercise AS id_exercise,
        exercises.name AS name,
        exercises.sets AS sets,
        exercises.reps AS reps,
        exercises.fk_muscle AS fk_muscle,
        muscle_groups.name AS muscle_group,
        exercises.fk_day AS fk_day,
        week_days.day AS day,
        exercises.fk_user_id as fk_user_id,
        exercises.explanation AS explanation
    FROM
        exercises
    JOIN
        muscle_groups ON exercises.fk_muscle = muscle_groups.id_muscle
    JOIN
        week_days ON exercises.fk_day = week_days.id_day
    WHERE
        exercises.fk_user_id = :id";

        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {

            print_r($stmt->errorInfo());
        }

        $stmt = null;
    }

    static public function updateExerciseData($name, $sets, $reps, $muscleGroup, $day, $explanation, $id)
    {
        $sql = "UPDATE exercises SET name  = :name, sets = :sets, reps = :reps, fk_muscle = :muscleGroup, fk_day = :day, explanation = :explanation WHERE id_exercise = :id";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':sets', $sets, PDO::PARAM_INT);
        $stmt->bindParam(':reps', $reps, PDO::PARAM_INT);
        $stmt->bindParam(':muscleGroup', $muscleGroup, PDO::PARAM_INT);
        $stmt->bindParam(':day', $day, PDO::PARAM_INT);
        $stmt->bindParam(':explanation', $explanation, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;

        } else {
            print_r($stmt->errorInfo());
            return false; 

        }
        $stmt = null;
    }

    static public function deleteExercise($id) {
        $sql = "DELETE FROM exercises WHERE id_exercise = :id_exercise";
        $stmt = model_sql::connectToDatabase()->prepare($sql);
        $stmt->bindParam(":id_exercise", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

}



?>