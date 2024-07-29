<section class="container-fluid py-3 text-center">
    <ul class="nav nav-pills">
        <?php if (isset($_GET['subfolder']) && ($_GET['subfolder'] == 'newExercise')) : ?>
            <li class="nav-item">
                <a class="nav-link active" href="index.php?pages=manageExercise&subfolder=newExercise">Crear ejercicio</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=manageExercise&subfolder=newExercise">Crear ejercicio</a>
            </li>
        <?php endif; ?>

        <?php if (isset($_GET['subfolder']) && ($_GET['subfolder'] == 'listExercise')) : ?>
            <li class="nav-item">
                <a class="nav-link active bg-primary text-white" href="index.php?pages=manageExercise&subfolder=listExercise">Ver listado de ejercicios</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?pages=manageExercise&subfolder=listExercise">Ver listado de ejercicios</a>
            </li>
        <?php endif; ?>
    </ul>
</section>

<?php
if (isset($_GET['subfolder'])) {
    if (($_GET['subfolder'] == "listExercise" || $_GET['subfolder'] == "newExercise")) {
        include "views/subfolder/" . $_GET['subfolder'] . ".php";
    }
} else {
    include "views/subfolder/listExercise.php";
}
?>