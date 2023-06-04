<?php
class Auth
{
    public static function requireLogin()
    {
        if (!static::isLoggedIn()) {
           
            Url::redirect("/offline.php?id=$id");
        }
    }

   
    public static function isLoggedIn()
    {
       
        return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
    }

    public static function login($userId)
    {
        session_regenerate_id(true);
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_id'] = $userId;
      

        return $userId;
    }

     public static function getUserId()
    {
       
        return self::isLoggedIn() ? $_SESSION['is_logged_in'] : null;
        
    }

    public static function logout()
    {
        
        session_unset();
        session_destroy();
    }

  
}
