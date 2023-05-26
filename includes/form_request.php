<?php

include_once("session.php");
include_once("functions.php");






// LOGIN ACCESS FOR ADMIN
// if(isset($_REQUEST["admin"])){

    $data = array();
    
    if(isset($_REQUEST["email"]) AND isset($_REQUEST["password"])){

        $admin_email = $_REQUEST["email"];
        $hash_password = $_REQUEST["password"];

        // GET ALL ADMIN FROM DATABASE
        $admin = select_all("admin");
        // CHECK ALL ADMIN IN THE DATABASE
        for ($i=0; $i < count($admin); $i++) {

            // $admin[$i]['admin_name'];
            // echo $admin[$i]['hash_password'];
            // echo "<br>";
            // echo $admin[$i]['admin_email'];
            $admin[$i]['hash_password'];
           
            $admin[$i]['admin_email'];

            // CHECK IF THE ADMIN LOGIN PASSWORD AND EMAIL IS CORRECT
            if(($admin_email == $admin[$i]['admin_email']) 
            AND ($hash_password == $admin[$i]['hash_password'])){
                $admin_access = "true";
                $_SESSION["admin"] = $admin_access;

                $data["success"] = $admin_access;
                $data["message"] = "welcome ". $admin_email;

                // $data = "<span>Login Sucessful: ". $admin_email ."</span>";
                // $data["redirect"] = '<script>
                //     function openLocation(){
                //         window.location="../admin/index.php"
                //     }
                //     openLocation();
                // </script>';
                break;
            }else{
                $data["message"] = "false";
                $data["success"] = "error ". $admin_email;
                continue;
            }

        }
        // END CHECKING ALL ADMIN IN THE DATABASE
        

    }


// $data = array();
// $data["name"] = "admin";
// $data["email"] = "admin@gmail.com";
// $data["password"] = "adminpassword";

echo json_encode($data);

// }


?>