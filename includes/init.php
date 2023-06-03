<?php

// Carga automática de clases
spl_autoload_register(function ($class) {
    $classFile = "/residencia/classes/{$class}.php";
    if (file_exists($classFile)) {
        require $classFile;
    }
});

// Inicio de sesión
session_start();

// Configuración de reporte de errores de MySQLi
mysqli_report(MYSQLI_REPORT_OFF);
