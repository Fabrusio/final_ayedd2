<?php
require 'config/MysqlDb.php';
// echo 'probado ';

spl_autoload_register(function ($class) {
	if (strpos($class, "Controller")) {
		require_once 'controllers/' . $class . '.php';
	}
	if (strpos($class, "Model")) {
		require_once 'models/' . $class . '.php';
	};
});

$index = new IndexController;
$index->run();


// model_sql::testConnection();

?>