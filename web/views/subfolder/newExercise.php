<div class="container pt-4 pb-3">
    <div class="row justify-content-center">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header bg-custom text-black text-center">
                    <h4 class="my-1 font-weight-bold">Nuevo ejercicio</h4>
                </div>
                <div class="card-body pb-0">
                    <form method='POST'>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="form-group px-2 py-2">Los campos con (<span class="text-danger">*</span>) son obligatorios.</p>
                            </div>
                            <div class="col-sm-12 col-md-6">
                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">
                                <div class="form-group">
                                    <label class="pt-1" for="exName">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="100" class="form-control" name="exName" placeholder="Ingrese el nombre del ejercicio" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="pt-1" for="sets">Sets <span class="text-danger">*</span></label>
                                    <input type="number" min="1" max="100" class="form-control" name="sets" placeholder="Ingrese el número de sets" value= "<?php echo isset($_POST['sets']) ? htmlspecialchars($_POST['sets']) : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="pt-1" for="reps">Repeticiones <span class="text-danger">*</span></label>
                                    <input type="number" min="1" max="100" class="form-control" name="reps" placeholder="Ingrese el número de repeticiones" value= "<?php echo isset($_POST['reps']) ? htmlspecialchars($_POST['reps']) : ''; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group px-2">
                                    <label class="pt-1" for="muscleGroup">Grupo muscular <span class="text-danger">*</span></label>
                                    <select class="form-control" id="muscleGroup" name="muscleGroup" required>
                                        <?php
                                        $selectedMuscle = isset($_POST['muscleGroup']) ? htmlspecialchars($_POST['muscleGroup']) : '';
                                        (new MusclesController())->muscleSelect($selectedMuscle);
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group px-2">
                                    <label class="pt-1" for="day">Día a entrenar <span class="text-danger">*</span></label>
                                    <select class="form-control" id="day" name="day" required>
                                        <?php
                                        $selectedDay= isset($_POST['day']) ? htmlspecialchars($_POST['day']) : '';
                                        (new DaysController())->daySelect($selectedDay);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 pt-3">
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="submit" name='loadExercise' class="btn bg-custom btn-block w-25 btn-warning">Crear</button>
                                </div>
                            </div>
                            <?php
                            if (isset($_POST['loadExercise'])) {
                                $controller = new ExerciseController();
                                $controller->newExercise();
                            }
                            ?>
                        </div>
                    </form>
                    <br>
                    <?php $message = new MessageController();
                    $message->showMessageVerify('message', "Se creó correctamente el ejercicio") ?>
                </div>
            </div>
        </div>
    </div>
</div>