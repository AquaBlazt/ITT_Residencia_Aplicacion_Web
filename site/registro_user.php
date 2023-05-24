<?php
require '\residencia\classes\Database.php';
require '\residencia\classes\ListaUsers.php';
require '\residencia\includes\url.php';




$ListaUser = new ListaUsers();

if($_SERVER["REQUEST_METHOD"]=="POST")
{
$db = new Database();
$conn = $db->getConn();


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
    
    redirect("/site/login.php?id={$ListaUser->id}");
    }
}

?>
 <?php require '\residencia\includes\header.php'; ?>
    <a href="login.php">Inicio</a>
    <title>Registro de Usuario</title>
<?php require '\residencia\includes\registro_formulario_user.php'; ?>
    <?php require '\residencia\includes\footer.php'; ?>