<?php
/** 
*Redireccionar a otra ventana
*
*Esta funcion permite la redireccion a cualquier otra ventana del programa 
*
*/
class Url
{
public static function redirect($path)
{
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
  {
    $protocol = 'https';
  }
  else
  {
    $protocol = 'http';
  }
  header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . $path);
  exit;
  }
}
?>