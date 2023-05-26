<?php
// SESSIONS
include_once("includes/session.php");

// $_SESSION['error'] = "no error";
// $_SESSION['message'] = "no message";
// echo "<a href='../test.php'>text.php</a>";



// PAGE HEADER
include_once("includes/header_new.php");
// CONFIGURATION
include_once("includes/config.php");


$admin_email = "";
$admin_password = "";
$input_error = "";
$page_name = "admin.php";
$message = "";
$error = "";

if(isset($_POST['submit'])){


        // START : CHECKING FOR INPUT
        $input_error = array();
        $admin_email = $_POST['admin_email'];
        $admin_password = $_POST['admin_password'];

        if(empty($admin_email)){
            $input_error['admin_email'] = "Email is required";
            $error = "Please fill in all fields";
        }
        if(empty($admin_password)){
            $input_error['admin_password'] = "Password is required";
            $error = "Please fill in all fields";
        }
        // END : CHECKING FOR INPUT


        if($error == ""){
            $admin_email = strilize_input($admin_email);
            $admin_password = strilize_input($admin_password);
    
            $admin_email = strtolower($admin_email);
            $admin_password = strtolower($admin_password);
            // CHECK IF admin ALREADY ON DATABASE
            $sql_verify_admin = "SELECT * FROM `admin` WHERE admin_email = '{$admin_email}' 
                    AND hash_password = '{$admin_password}'";
            $result_verfy_admin = mysqli_query($conn, $sql_verify_admin);
            if(mysqli_num_rows($result_verfy_admin) > 0){
         
                $message = "Login Sucessful: [ {$admin_email} ] Verified!.";
                $_SESSION['admin'] = "true";

                $redirect = "<script>
                            setTimeout(() => window.location = \"admin/\", 3000);
                        </script>";
                echo $redirect;
            }else{

                $error = "Login Error: [ {$admin_email} ] or Password Incorrect!.";

            }
        }

}

?>




<!-- START OF PAGE -->
<div class="page">

    
    <!-- START OF BODY -->
    <div class="w-full text-center px-6">
        <!-- header -->
        <div class="p-3 my-3 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-center text-gray-600">Login Admin</h2>
        </div>
        <!-- START OF FORM CONTENT -->
        <div class="p-6 mx-auto my-auto text-left bg-white shadow-lg w-[50%]  h-auto m-auto">
            <form action="<?php echo $page_name;?>" method="post" id="form">
                    <!-- MESSAGE FROM FORM VALIDATION -->
                    <div class="text-xs text-center lex w-full justify-between w-full">
                        <span class="text-xs text-center text-green-400" id="message"><?php echo $message;?></span>
                        <span class="text-xs text-center text-red-400" id="error"><?php echo $error;?></span>
                    </div>

                    <pre>
                        <?php //print_r($input_error);?>
                    </pre>

                    <div class="w-full justify-center items-center">
                        <!-- ENTER YOUR admin_email  -->
                        <div class="mt-4 md:ml-2">
                            <label class="block" for="email">Email<label>
                                    <input type="text" placeholder="example@gmail.com"
                                        name="admin_email"
                                        value="<?php echo (isset($admin_email) AND !empty($admin_email))? "{$admin_email}": "";?>"
                                        class="<?php echo (isset($input_error['admin_email']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <?php 
                                        if(isset($input_error['admin_email'])){
                                            $admin_email_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['admin_email']}</span>";
                                            echo $admin_email_error;
                                        }
                                    ?>
                        </div>
                        <!-- ENTER YOUR admin_password  -->
                        <div class="mt-4 md:ml-2">
                            <label class="block" for="admin_password">Password<label>
                                    <input type="password" placeholder="******" id="admin_password"
                                        name="admin_password"
                                        value="<?php echo (isset($admin_password) AND !empty($admin_password))? "{$admin_password}": "";?>"
                                        class="<?php echo (isset($input_error['admin_password']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <?php 
                                        if(isset($input_error['admin_password'])){
                                            $admin_password_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['admin_password']}</span>";
                                            echo $admin_password_error;
                                        }
                                    ?>
                        </div>

                    </div>  

                    <div class="flex items-center justify-center h-10 intro-y my-6">
                        <button id="send_form" 
                        name="submit"
                        class="text-base mx-2  hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                            hover:bg-[#02669d] 
                            bg-[#08a7fd]
                            text-gray-100 hover:border-[#02669d]
                            border duration-200 ease-in-out 
                            border-[#08a7fd] transition"><i class="fa fa-rocket m-1 pr-2"></i> Login
                        </button>
                    </div>
            </form>
        </div>
        <!-- END OF FORM CONTENT -->
    </div>
    <!-- END OF BODY -->
  

</div>
<!-- END OF PAGE -->



<?php
// PAGE FOOTER
include_once("includes/footer.php");
?>