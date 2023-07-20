<?php


spl_autoload_register(function ($class) {
    $classFile = "classes/{$class}.php";
    if (file_exists($classFile)) {
        require $classFile;
    }
});


session_start();


mysqli_report(MYSQLI_REPORT_OFF);
