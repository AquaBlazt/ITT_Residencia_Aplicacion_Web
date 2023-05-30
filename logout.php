<?php 
require '\residencia\includes\init.php';

Auth::logout();
Url::redirect('/login.php');

?>