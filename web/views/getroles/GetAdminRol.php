<?php

if (
      ($_GET['pages'] == "home") ||
      ($_GET['pages'] == "manageExercise") ||
      ($_GET['pages'] == "manageUser") ||
      # links simples
      ($_GET['pages'] == "changePassword")
) {
      include "views/pages/" . $_GET['pages'] . ".php";
} elseif ($_GET['pages'] == "logout") {
      include "views/pages/logout.php";
} else {
      include "views/pages/error404.php";
}
