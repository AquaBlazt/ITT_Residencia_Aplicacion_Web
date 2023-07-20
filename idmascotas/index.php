<?php
require 'includes/init.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = require 'includes/db.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $userId = Auth::getUserId();
    Auth::login($userId);

    if (ListaUsers::authenticate($conn, $email, $password) === 'user')
    {
   
        Url::redirect('/lista_mascotas.php');     
        
    } 
    
    elseif (ListaUsers::authenticate($conn, $email, $password) === 'admin')
    {
        Url::redirect('/lista_mascotas_admin.php');
      
    }
    else
    {
        $error = "Error al iniciar sesión";
    }
}


?>

<?php require 'includes/header.php'; ?>

<h1>Inicio de Sesión</h1>
<?php if (!empty($error)) : ?>
    <p><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
    <div>
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required />
    </div>
    <div>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required />
    </div>
    <button type="submit">Iniciar Sesión</button>
    <p>Si no tienes cuenta, <a href="registro_user.php">regístrate aquí.</a></p>
    <p>¿Encontraste a una mascota?<a href = "consulta.php"> comunicate con su dueño aqui.</a></p>
</form>

<?php require 'includes/footer.php'; ?>
