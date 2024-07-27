<?php if ($_SESSION['fk_rol_id'] == 1) : ?>
    <section class="container text-center">
        <h3 class="display-4 py-3">Administración para rutina de ejercicios</h3>
        <p class="lead">Bienvenido a esta aplicación. Se le brindará la posibilidad de gestionar sus ejercicios y rutinas a la hora de entrenar, y podrá registrar nuevos usuarios con los que quiera compartir esta app.</p>
        <div class="text-left">
            <div class="menu-section">
                <h4 class="my-3"><i class="fas fa-pen"></i>Funcionalidades</h4>
                <ul>
                    <li>Crear nuevos ejercicios para su calendario.</li>
                    <li>Editar detalles que expliquen cómo han de realizarse.</li>
                    <li>Eliminarlo en caso de que no caiga mas en su rutina.</li>
                </ul>
            </div>

            <div class="menu-section">
                <h4 class="my-3"><i class="fas fa-users"></i>Gestión de Usuarios</h4>
                <ul>
                    <li>Registrar nuevos usuarios comunes o personal administrativo</li>
                    <li>Ver y gestionar todos los usuarios existentes</li>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ($_SESSION['fk_rol_id'] == 2) : ?>
    <section class="container text-center">
        <h3 class="display-4 py-3">Aplicación para rutina de ejercitamiento</h3>
        <p class="lead">Bienvenido a esta aplicación. La idea es administrar un poco tu rutina de ejercicios semanal.</p>

        <div class="text-left">
            <div class="menu-section">
                <h4 class="my-3"><i class="fas fa-pen"></i>Funcionalidades</h4>
                <ul>
                    <li>Crear nuevos ejercicios para su calendario.</li>
                    <li>Editar detalles que expliquen (si lo desea) cómo han de realizarse.</li>
                    <li>Eliminarlo en caso de que no caiga mas en su rutina.</li>
                </ul>
            </div>

        </div>
    </section>
<?php endif; ?>