<?php
function redirect_to($page_name){
    header("Location: {$page_name}");
    exit;
}

?>