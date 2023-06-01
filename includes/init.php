<?php

spl_autoload_register(function ($class) {
  require "/residencia/classes/{$class}.php";
});

session_start();
mysqli_report(MYSQLI_REPORT_OFF);


