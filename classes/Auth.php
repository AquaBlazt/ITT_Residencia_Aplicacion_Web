<?php
class Auth
{
    public static function requireLogin()
    {
        if (!static::isLoggedIn()) {
            // Redireccionar al usuario a la página de inicio de sesión
            Url::redirect("/offline.php?id=$id");
        }
    }

    public static function login($userId)
    {
        session_regenerate_id(true);
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_id'] = $userId;
    }

    public static function logout()
    {
        // Limpiar y destruir la sesión
        session_unset();
        session_destroy();
    }

    public static function isLoggedIn()
    {
        // Verificar si el usuario ha iniciado sesión
        return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
    }

    public static function getUserId()
    {
        // Obtener el ID del usuario si ha iniciado sesión
        return self::isLoggedIn() ? $_SESSION['user_id'] : null;
    }
}
