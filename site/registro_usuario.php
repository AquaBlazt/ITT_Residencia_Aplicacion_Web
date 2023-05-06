<?php
require '\residencia\includes\database.php';
$conn=getDB();

$errors=[];
$name='';
$email='';
$password='';
$password_confirmation='';
$phone_number='';
$phone_number_extra='';
$address='';

if($_SERVER["REQUEST_METHOD"]=="POST")
{
$name= $_POST['name'];
$email= $_POST['email'];
$password= $_POST['password'];
$password_confirmation=$_POST['password_confirmation'];
$phone_number= $_POST['phone_number'];
$phone_number_extra= $_POST['phone_number_extra'];
$address= $_POST['address'];


if($name=='')
{
  $errors[]='Se requiere un nombre';
}
if(! filter_var($email, FILTER_VALIDATE_EMAIL))
{
  $errors[]='Se requiere un E-mail valido';
}
if($password == '')
{
  $errors[]='Se requiere una contraseña';
}
if($password !== $password_confirmation)
{
  $errors[]='Las contraseñas no coinciden';
}
if($address=='')
{
  $errors[]='Se requiere una direccion';
}
if($phone_number=='')
{
  $errors[]='Se requiere al menos un numero telefonico';
}
if($phone_number==$phone_number_extra)
{
$errors[]='No puedes introducir los mismos numeros telefonicos';
}
if($address=='')
{
  $errors[]='Se requiere una direccion';
}



$password_hash= password_hash($password, PASSWORD_DEFAULT);

if(empty($errors))
{
$conn=getDB();
mysqli_report(MYSQLI_REPORT_OFF);
  $sql= "INSERT INTO registro_usuario (name,email,password_hash,address,phone_number,phone_number_extra)
  VALUES (?, ?, ?, ?, ?, ?)";
   
  $stmt= mysqli_prepare($conn, $sql);
  
  if($stmt===false)
  {
    echo mysqli_error($conn);
  }
  else
  {

    if($phone_number_extra=='')
    {
      $phone_number_extra = null;
    }

    mysqli_stmt_bind_param($stmt, "ssssss",$name, $email, $password_hash, $address, $phone_number, $phone_number_extra);  
if(mysqli_stmt_execute($stmt))
{
  $id = mysqli_insert_id($conn);
  echo "Se inserto la informacion con el ID: $id";
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')
{
  $protocol = 'https';
}
else
{
  $protocol = 'http';
}
  header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/site/inicio.php?id=$id");
  exit;
}
else
{
  if ($conn->errno === 1062) {
    $errors[]="Ya existe un registro con el e-mail introducido";
} else {
    die($conn->error . " " . $conn->errno);
}
  
}
  }
 }
}
?>
 <?php require '\residencia\includes\header.php'; ?>
 <a href="inicio.php">Inicio</a>
    <title>Registro de Usuario</title>
    <?php require '\residencia\includes\registro_formulario_usuario.php'; ?>
    <?php require '\residencia\includes\footer.php'; ?>
