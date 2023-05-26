<?php

include_once("../includes/redirect_to.php");
include_once("../includes/session.php");

// LOGOUT FUNCTION REDIRECT TO HOME PAGE
function logout(){

    $_SESSION['admin'] = false;

    session_destroy();
    redirect_to("../index.php");

}
logout();


?>