<?php

class ListaUsers
{
  public $id;
  public $type;
  public $name;
  public $email;
  public $password;
  public $password_hash;
  public $password_confirmation;
  public $address;
  public $phone_number;
  public $phone_number_extra;
  public $errors= [];

protected function validate()
{
if($this->name=='')
{
  $this->errors[]='Se requiere un nombre';
}

if(! filter_var($this->email, FILTER_VALIDATE_EMAIL))
{
  $this->errors[]='Se requiere un E-mail valido';
}

if($this->password=='')
{
  $this->errors[]='Se requiere una contraseña';
}

if($this->password !== $this-> password_confirmation)
{
  $this->errors[]='Las contraseñas no coinciden';
}

if($this->address=='')
{
  $this->errors[]='Se requiere una direccion';
}

if($this->phone_number=='')
{
  $this->errors[]='Se requiere al menos un numero telefonico';
}

if($this->phone_number == $this->phone_number_extra)
{
  $this->errors[]='No puedes introducir los mismos numeros telefonicos';
}

if (empty($this->id) && $this->emailExists($this->email))
{
  $this->errors[]='Ya existe un registro con ese email';
}
  
return empty($this->errors);

}

protected function emailExists($email)
{
 
  $sql = "SELECT *
  FROM registro_usuario
  WHERE email = :email";
$db = Database::getConn();
$stmt = $db->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);

$stmt->execute();
return $stmt->fetch() !== false;

}

public function create($conn)
{
  if ($this->validate())
  {
  $sql= "INSERT INTO registro_usuario (name, email, password, address, phone_number, phone_number_extra)
           VALUES (:name,
                   :email,
                   :password,
                   :address,
                   :phone_number,
                   :phone_number_extra)";    
        
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare($sql);

          $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
          $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
          $stmt->bindValue(':password', $this->password_hash, PDO::PARAM_STR);
          $stmt->bindValue(':address', $this->address, PDO::PARAM_STR);
          $stmt->bindValue(':phone_number', $this->phone_number, PDO::PARAM_STR);
          $stmt->bindValue(':phone_number_extra', $this->phone_number_extra, PDO::PARAM_STR);
          
          if ($this->phone_number_extra == '') 
          {
            $stmt->bindValue(':phone_number_extra', null, PDO::PARAM_NULL);
          } 
          else 
          {
            $stmt->bindValue(':phone_number_extra', $this->phone_number_extra, PDO::PARAM_STR);
          }  
        
          if ($stmt->execute()) 
          {
            $this->id = $conn->lastInsertId();
            return true;
          }
  }
  else
  {
    return false;
  }
}


public static function authenticate($conn, $email, $password)
  {
    $sql = "SELECT *
            FROM registro_usuario
            WHERE email = :email";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);

    $stmt->setFetchMode(PDO::FETCH_CLASS, 'ListaUsers');

    $stmt->execute();
    
    if ($user = $stmt->fetch())
    {

      return password_verify($password, $user->password);   
    }  
  }

  
public static function authenticateAdmin($conn, $email, $password)
 {
 
  $sql = "SELECT * 
            FROM registro_usuario 
            WHERE type = 'admin' AND email = :email";           
            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'ListaUsers');
            $stmt->execute();
            if ($user = $stmt->fetch())
            {
        
              return password_verify($password, $user->password);   
            }  
 }


}

