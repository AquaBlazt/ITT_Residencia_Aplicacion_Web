<?php
/** 
*Autenticacion del usuario
*
*@return boolean true si el usuario inicio sesion, de ser lo contrario sera falso
*
*/
class Auth
{
  


public static function requireLogin()
{
  if (! static::isLoggedIn())
  {
   
    Url::redirect("/offline.php?id=$id");
  }
}

public static function login($userId) {
  session_regenerate_id(true);
  $_SESSION['is_logged_in'] = true;
  $_SESSION['user_id'] = $userId;
}


public static function logout()
{
  $_SESSION = array();
if(ini_get("session.use_cookies"))
{
  $params = session_get_cookie_params();
  setcookie(session_name(), '', time() - 42000,
  $params["path"], $params["domain"],
  $params["secure"], $params["httponly"]);
}

session_destroy();
}

public static function isLoggedIn()
{

  
return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];

}

public static function getUserId() {
  if (self::isLoggedIn()) {
    return $_SESSION['user_id'];
  } else {
    return null;
  }
}



}