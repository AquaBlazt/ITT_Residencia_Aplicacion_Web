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
    session_start();
    $_SESSION["user_id"] = $registro_usuario["id"];

    session_regenerate_id();
    header("Location: menu.php");
    exit;
  }

}

$invalido = true;

}

?>
 <?php require '\residencia\includes\header.php'; ?>
    <title>Inicio de Sesion</title>
  </head>
  <body>
    <div class="container">
      <div class="form-container">
      <?php require '\residencia\includes\inicio_sesion.php'; ?>
        <a href="registro_usuario.php">¿No tienes cuenta? Registrate ahora</a>
      </div>
    </div>
    <?php require '\residencia\includes\footer.php'; ?>
