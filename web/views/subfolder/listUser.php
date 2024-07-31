<?php $dataUser = UserController::getAllUser(); ?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example3" class="table table-bordered table-striped table-hover" style="width: 80%; margin: 0 auto;">
                <thead class="bg-yellow text-white">
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Rol</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataUser as $user) : ?>
                        <?php if ($_SESSION['id_user'] != $user['id_user']) : ?>
                            <tr class="<?php echo ($user['state'] == 1) ? 'bg-white' : 'bg-light'; ?>">
                                <td class="text-center"><?php echo $user['name']; ?></td>
                                <td class="text-center"><?php echo $user['email']; ?></td>
                                <td class="text-center"><?php echo $user['name_rol']; ?></td>
                                <td class="text-center"><?php echo $user['state'] == 1 ? 'Activo' : 'Inactivo'; ?></td>
                                <?php if (isset($_GET['pages']) && ($_GET['pages'] == 'manageUser')) : ?>
                                    <td class="text-center">
                                        <a href="#editUserModal<?php echo $user['id_user']; ?>" class="btn btn-primary edit-user" data-toggle="modal">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php if ($user['state'] == 1) : ?>
                                            <a href="index.php?pages=manageUser&action=deshabilitar_cuenta&id_user=<?php echo $user['id_user'] ?>" class="btn btn-success" title="Deshabilitar cuenta"><i class="fas fa-toggle-on"></i></a>
                                        <?php else : ?>
                                            <a href="index.php?pages=manageUser&action=habilitar_cuenta&id_user=<?php echo $user['id_user'] ?>" class="btn btn-danger" title="Habilitar cuenta"><i class="fas fa-toggle-off"></i></a>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php if (isset($_GET['action'])) {
    if ($_GET['action'] == "deshabilitar_cuenta") {
        $controller = new UserController();
        $controller->disableAccountUser();
    }

    if ($_GET['action'] == "habilitar_cuenta") {
        $controller = new UserController();
        $controller->enableAccountUser();
    }
} ?>
<?php foreach ($dataUser as $user) : ?>
    <!-- Modal de edición de usuario -->
    <div class="modal fade" id="editUserModal<?php echo $user['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header alert alert-warning">
                    <h5 class="modal-title" id="editUserModalLabel"><strong>Editar usuario</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                        <div class="form-group">
                            <label for="mail">Correo electrónico</label>
                            <input type="email" maxlength="100" class="form-control" id="mail" name="mail" value="<?php echo $user['email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" maxlength="100" class="form-control" id="name" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo se permiten letras y espacios" name="name" required value="<?php echo $user['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="roles">Rol</label>
                            <select class="form-control" id="roles" name="roles" required>
                                <option value="<?php echo $user['fk_rol_id'] ?>"><?php echo $user["name_rol"] ?></option>
                                <?php (new RolesController())->allRolesSelect(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gender">Género</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="<?php echo $user['fk_gender_id'] ?>"><?php echo $user["gender"] ?></option>
                                <?php (new GendersController())->allGendersSelect(); ?>
                            </select>
                        </div>
                        <button type="submit" name="savechange" class="btn btn-warning">Guardar cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>

<?php if (isset($_POST['savechange'])) {
    $controller = new UserController();
    $controller->editarUser();
}
?>