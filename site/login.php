<?php
require '\residencia\classes\Url.php';
require '\residencia\classes\ListaUsers.php';
require '\residencia\classes\Database.php';

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$db = new Database();
$conn = $db->getConn();

if (ListaUsers::authenticate($conn, $_POST['email'], $_POST['password']))
{
  session_regenerate_id(true);
  $_SESSION['is_logged_in'] = true;
  Url::redirect('/site/menu.php');
}
else
{
  $error = "Error al Iniciar Sesion";
}

}

?>
<?php require '\residencia\includes\header.php'; ?>

<h1>Inicio de Sesion</h1>
<?php if (! empty($error)) : ?>
  <p><?= $error ?></p>
  <?php endif; ?>

<form method="post">
<div>

          <label for="email">E-mail</label>
          <input name="email" id="email"/>
</div>
<div>

          <label for="password">Contraseña</label>
          <input type="password" name="password" id="password"/>
</div>
<button> Iniciar Sesion </button>
<p>Si no tienes cuenta, <a href ="registro_user.php">registrate aqui</a></p>
</form>


<?php require '\residencia\includes\header.php'; ?>
