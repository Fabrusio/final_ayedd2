<?php

class ExerciseController{

    static public function newExercise(){
        if((!empty($_POST['exName'])) && (!empty($_POST['sets'])) && (!empty($_POST['reps'])) 
            && (!empty($_POST['muscleGroup'])) && (!empty($_POST['day'])) && (!empty($_POST['id_user']))){

            $name = strtolower(trim($_POST['exName']));
            $sets = intval($_POST['sets']);
            $reps = intval($_POST['reps']);

            if($sets < 1 || $reps < 1){
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-danger mt-2">Los sets y/o repeticiones no pueden ser menores a 1.</div>
                    </div>
                </div>';
                return;
            }
            if($sets > 100 || $reps > 100){
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-danger mt-2">Los sets y/o repeticiones no pueden ser mayores a 100.</div>
                    </div>
                </div>';
                return;
            }

            $muscleGroup = $_POST['muscleGroup'];
            $day = $_POST['day'];
            $id = $_POST['id_user'];

            $execute = ExerciseModel::createExercise($name, $sets, $reps, $muscleGroup, $day, $id);

            if($execute){
                echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-success mt-2">Ejercicio creado correctamente</div>
                    </div>
                </div>';
            }

        }else{
            echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                </script>
                <div class="col-sm-12 pt-3">
                    <div class="d-flex justify-content-center align-items-center">             
                        <div class="alert alert-danger mt-2">Debes completar los campos</div>
                    </div>
                </div>';
        }
    }


}



?>