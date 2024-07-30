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
            $explanation = strtolower(trim($_POST['explanation']));

            $execute = ExerciseModel::createExercise($name, $sets, $reps, $muscleGroup, $day, $id, $explanation);

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

    static public function getAllExercises($id)
    {
        $id = $_SESSION['id_user'];
        return ExerciseModel::getAllExercises($id);
    }

    static public function editExercise()
    {
        $id = $_POST['id_exercise'];
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
        $explanation = strtolower(trim($_POST['explanationEd']));

        $execute = ExerciseModel::updateExerciseData($name, $sets, $reps, $muscleGroup, $day, $explanation, $id);

        if($execute){
            echo '<script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }

            window.location="../index.php?pages=manageExercise&subfolder=listExercise&message=correcto";
            </script>
            <div class="alert alert-succes mt-2">Se editó correctamente.</div>';
        } else {
            echo '<script>
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
                window.location="../index.php?pages=manageExercise&subfolder=listExercise";
                </script>
                <div class="alert alert-danger mt-2">Hubo un problema al editarlo.</div>';
        }
    }

    public function deleteExercise() {
        if (isset($_GET['id_exercise'])) {
            
            $id = intval($_GET['id_exercise']);
            $deleted = ExerciseModel::deleteExercise($id);

            if ($deleted) {
                echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Eliminado!",
                    text: "El ejercicio ha sido eliminado.",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?pages=manageExercise&subfolder=listExercise";
                    }
                });
                </script>';
            } else {
                echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Hubo un problema al eliminar el ejercicio.",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?pages=manageExercise&subfolder=listExercise";
                    }
                });
                </script>';
            }
        }
    }


}



?>