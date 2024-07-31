<?php $data = UserController::sessionDataUser($_SESSION['id_user']) ?>

    <li class="nav-item mb-1">
        <a href="index.php?pages=manageExercise" class="nav-link">
            <i class="fas fa-dumbbell nav-icon"></i>
            <p>Ejercicios</p>
        </a>
    </li>

    <li class="nav-item mb-1">
        <a href="index.php?pages=manageUser" class="nav-link">
            <i class="fas fa-users-cog nav-icon"></i>
            <p>Gestión de usuarios</p>
        </a>
    </li>
