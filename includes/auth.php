<?php

/** 
*Autenticacion del usuario
*
*@return boolean true si el usuario inicio sesion, de ser lo contrario sera falso
*
*/

function isLoggedIn()
{
  return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
}