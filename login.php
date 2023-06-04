<?php
require '/residencia/includes/init.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = require '/residencia/includes/db.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (ListaUsers::authenticateAdmin($conn, $email, $password)) 
    {
        $userId = Auth::getUserId();
        Auth::login($userId);
        Url::redirect('/admin/lista_mascotas.php');
    } 
    elseif (ListaUsers::authenticate($conn, $email, $password)) 
    {
        $userId = Auth::getUserId();
        Auth::login($userId);
        var_dump($userId);
        Url::redirect('/lista_mascotas.php');
    } 
    else 
    {
        $error = "Error al iniciar sesión";
    }
}

?>

<?php require '/residencia/includes/header.php'; ?>

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
    <p>Si no tienes cuenta, <a href="registro_user.php">regístrate aquí</a></p>
</form>

<?php require '/residencia/includes/footer.php'; ?>
