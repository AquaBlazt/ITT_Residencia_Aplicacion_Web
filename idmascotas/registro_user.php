<?php
require 'includes/init.php';


$ListaUser = new ListaUsers();

if($_SERVER["REQUEST_METHOD"]=="POST")
{

$conn = require 'includes/db.php';

  $ListaUser->name = $_POST['name'];
  $ListaUser->email  = $_POST['email'];
  $ListaUser->password = $_POST['password'];
  $ListaUser->password_confirmation = $_POST['password_confirmation'];
  $ListaUser->address = $_POST['address'];
  $ListaUser->phone_number = $_POST['phone_number'];
  $ListaUser->phone_number_extra = $_POST['phone_number_extra'];
  
  $ListaUser->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

  
 
  if($ListaUser->create($conn))
    {
    
    Url::redirect("/index.php?id={$ListaUser->id}");

    }
}

?>
 <?php require 'includes/header.php'; ?>
    <a href="index.php">Inicio</a>
    <title>Registro de Usuario</title>
<?php require 'includes/registro_formulario_user.php'; ?>
    <?php require 'includes/footer.php'; ?>