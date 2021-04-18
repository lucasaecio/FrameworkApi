<?php

spl_autoload_register(function (String $class_name) {

    require_once("vendor/autoload.php");

    $class_name = strtolower($class_name);

    // verificando na pasta atual
    if (file_exists("{$class_name}.php")) {
        require_once("{$class_name}.php");
    }

    // verificando dentro de core
    if (file_exists("core/{$class_name}.class.php")) {
        require_once("core/{$class_name}.class.php");
    }

    // verificando dentro dos controller
    if (file_exists("src/controller/{$class_name}.controller.php")) {
        require_once("src/controller/{$class_name}.controller.php");
    }

    // verificando dentro dos modules
    if (file_exists("src/model/{$class_name}.model.php")) {
        require_once("src/model/{$class_name}.model.php");
    }

    // verificando dentro dos middleware
    if (file_exists("src/middleware/{$class_name}.php")) {
        require_once("src/middleware/{$class_name}.php");
    }

    // verificando dentro dos helpers
    if (file_exists("src/helpers/{$class_name}.help.php")) {
        require_once("src/helpers/{$class_name}.help.php");
    }
});
