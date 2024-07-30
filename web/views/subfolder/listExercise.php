<?php $dataExercise = ExerciseController::getAllExercises($_SESSION['id_user']); ?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" class="table table-bordered table-striped table-hover" style="width: 90%; margin: 0 auto;">
                <thead class="bg-yellow text-white">
                    <tr>
                        <th class="text-center">Día a realizar</th>
                        <th class="text-center">Ejercicio</th>
                        <th class="text-center">Sets y repeticiones</th>
                        <th class="text-center">Grupo muscular</th>
                        <th class="text-center">Explicación</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataExercise as $exercise) : ?>
                        <tr>
                            <td class="text-center"><?php echo $exercise['fk_day'] . ' - ' . $exercise['day']; ?></td>
                            <td class="text-center"><?php echo $exercise['name']; ?></td>
                            <td class="text-center"><?php echo $exercise['sets'] .' de '. $exercise['reps']; ?></td>
                            <td class="text-center"><?php echo $exercise['muscle_group']; ?></td>
                            <td class="text-center"><?php if(isset($exercise['explanation']) && $exercise['explanation'] != ''){
                                echo $exercise['explanation']; 
                            }else{ echo 'Sin explicación'; }
                            ?>
                            </td>
                            <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'manageExercise')) : ?>
                                <td class="text-center">
                                    <a href="#editUserModal<?php echo $exercise['id_exercise']; ?>" class="btn btn-primary edit-user" data-toggle="modal">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="javascript:void(0);" class="btn btn-danger" title="Eliminar ejercicio" onclick="confirmDelete(<?php echo $exercise['id_exercise']; ?>)"><i class="fas fa-trash"></i></a>
                                
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>
function confirmDelete(id_exercise) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esto",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'index.php?pages=manageExercise&action=borrar&id_exercise=' + id_exercise;
        }
    })
}
</script>

<?php if (isset($_GET['action'])) {
        if ($_GET['action'] == "borrar") {
            $controller = new ExerciseController();
            $controller->deleteExercise();
        }
    }
?>

<?php foreach ($dataExercise as $exercise) : ?>
    <!-- Modal de edición de ejercicio -->
    <div class="modal fade" id="editUserModal<?php echo $exercise['id_exercise']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-warning">
                    <h5 class="modal-title" id="editUserModalLabel"><strong>Editar ejercicio</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="id_exercise" value="<?php echo $exercise['id_exercise']; ?>">
                        <div class = "row">
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="exName">Nombre </label>
                                    <input type="text" maxlength="100" class="form-control" name="exName" value="<?php echo $exercise['name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="sets">Sets</label>
                                    <input type="number" min="1" max="100" class="form-control" name="sets" value= "<?php echo $exercise['sets']?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="reps">Reps</label>
                                    <input type="number" min="1" max="100" class="form-control" name="reps" value= "<?php echo $exercise['reps']?>" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="day">Día</label>
                                    <select class="form-control" id="day" name="day" required>
                                        <option value="<?php echo $exercise['fk_day'] ?>"><?php echo $exercise["day"] ?></option>
                                        <?php (new DaysController())->allDaysSelect(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="muscleGroup">Grupo muscular</label>
                                    <select class="form-control" id="muscleGroup" name="muscleGroup" required>
                                        <option value="<?php echo $exercise['fk_muscle'] ?>"><?php echo $exercise["muscle_group"] ?></option>
                                        <?php (new MusclesController())->allMusclesSelect(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="explanationEd">Explicación</label>
                                    <textarea maxlength="1000" class="form-control" name="explanationEd" rows="4"><?php echo $exercise['explanation']; ?></textarea>                                </div>
                            </div>
                        </div>
                        <button type="submit" name="savechange" class="btn btn-warning">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>

<?php if (isset($_POST['savechange'])) {
    $controller = new ExerciseController();
    $controller->editExercise();
}
?>
