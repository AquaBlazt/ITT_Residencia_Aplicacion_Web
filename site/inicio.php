<?php
require '\residencia\includes\database.php';
$conn=getDB();
mysqli_report(MYSQLI_REPORT_OFF);

$invalido = false;
if( $_SERVER["REQUEST_METHOD"] === "POST")
{
$sql = sprintf("SELECT * FROM registro_usuario 
WHERE email = '%s'",
$conn->real_escape_string($_POST["email"]));

$result = $conn->query($sql);
$registro_usuario = $result->fetch_assoc();

if($registro_usuario)
{

  if(password_verify($_POST["password"], $registro_usuario["password_hash"]))
  {
    die("inicio sesion correctamente");
  }

}

$invalido = true;

}

?>
<!DOCTYPE html>
<html lang="esp">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/css/style.css" rel="stylesheet" />
    <title>Inicio</title>
  </head>
  <body>
    <div class="container">
      <div class="form-container">
        <form action="" method="post">
          <h1>Inicio de Sesion</h1>
          <?php if ($invalido): ?>
            <em>Inicio de sesion invalido</em>
            <?php endif; ?>
          <input
            type="text"
            placeholder="E-mail"
            class="field"
            name="email"
            id="email"
            value="<?= htmlspecialchars($_POST["email"] ?? "") ?>"
          />

          <input
            type="password"
            placeholder="Contraseña"
            class="field"
            name="password"
          />

          <button type="submit" class="form-btn" name="log-in">
            Iniciar sesion
          </button>
          
        </form>
        <a href="registro_usuario.php">¿No tienes cuenta? Registrate ahora</a>
      </div>
    </div>
  </body>
</html>
