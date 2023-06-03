<?php
require '\residencia\includes\init.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $conn = require '\residencia\includes\db.php';

  if (ListaUsers::authenticateAdmin($conn, $_POST['email'], $_POST['password'])) {
    $userId = Auth::getUserId();
    Auth::login($userId);
    Url::redirect('/admin/lista_mascotas.php');
  } elseif (ListaUsers::authenticate($conn, $_POST['email'], $_POST['password'])) {
    $userId = Auth::getUserId();
    Auth::login($userId);
    Url::redirect('/lista_mascotas.php');
  } else {
    $error = "Error al Iniciar Sesión";
  }
}
?>

<?php require '\residencia\includes\header.php'; ?>

<h1>Inicio de Sesión</h1>
<?php if (!empty($error)) : ?>
  <p><?= $error ?></p>
<?php endif; ?>

<form method="post">
  <div>
    <label for="email">E-mail</label>
    <input name="email" id="email" />
  </div>
  <div>
    <label for="password">Contraseña</label>
    <input type="password" name="password" id="password" />
  </div>
  <button>Iniciar Sesión</button>
  <p>Si no tienes cuenta, <a href="registro_user.php">regístrate aquí</a></p>
</form>

<?php require '\residencia\includes\footer.php'; ?>

