<div class="container pt-4 pb-3">
    <div class="row justify-content-center">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-header bg-custom text-black text-center">
                    <h4 class="my-1 font-weight-bold">Nuevo usuario</h4>
                </div>
                <div class="card-body pb-0">
                    <form method='POST'>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="form-group px-2 py-2">Los campos con (<span class="text-danger">*</span>) son obligatorios.</p>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label class="pt-1" for="name">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" maxlength="100" class="form-control" name="name" placeholder="Ingrese el nombre" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="pt-1" for="mail">Correo electrónico <span class="text-danger">*</span></label>
                                    <input type="email" maxlength="100" class="form-control" name="mail" placeholder="Ingrese el correo electrónico" value="<?php echo isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : ''; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group px-2">
                                    <label class="pt-1" for="gender">Género <span class="text-danger">*</span></label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <?php
                                        $selectedGender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '';
                                        (new GendersController())->gendersSelect($selectedGender);
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group px-2">
                                    <label class="pt-1" for="roles">Rol <span class="text-danger">*</span></label>
                                    <select class="form-control" id="roles" name="roles" required>
                                        <?php
                                        $selectedRole = isset($_POST['roles']) ? htmlspecialchars($_POST['roles']) : '';
                                        (new RolesController())->rolesSelect($selectedRole);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 pt-3">
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="submit" name='loadUser' class="btn bg-custom btn-block w-25 btn-warning">Crear</button>
                                </div>
                            </div>
                            <?php
                            if (isset($_POST['loadUser'])) {
                                $controller = new UserController();
                                $controller->newUser();
                            }
                            ?>
                        </div>
                    </form>
                    <br>
                    <?php $message = new MessageController();
                    $message->showMessageVerify('message', "Se creó correctamente el usuario") ?>
                </div>
            </div>
        </div>
    </div>
</div>