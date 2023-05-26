<?php
session_start();

// Error message
    function session_error(){
        $error = (isset($_SESSION['error'])) ? $_SESSION['error'] : "";
        // clear error after use
        $_SESSION['error'] = "";
        // return error if any
        return htmlentities($error);
    }
// Sucess message
    function session_message(){
        $message = (isset($_SESSION['message'])) ? $_SESSION['message'] : "";
        // clear message after use
        $_SESSION['message'] = "";
        // return message if any
        return htmlentities($message);
    }
?>