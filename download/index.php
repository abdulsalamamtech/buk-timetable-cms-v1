<?php

// CHECK IF ADMIN LOGIN IS SUCESSFUL : ELSE SEND ADMIN BACK TO HOME PAGE
if(empty($_SESSION['admin'])){

  $redirect = "<script>
                  window.location = '../index.php';
              </script>";
  echo $redirect;
  logout_access();
}



?>