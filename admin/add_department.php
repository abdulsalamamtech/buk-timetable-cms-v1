<?php
// SESSIONS
include_once("../includes/session.php");
// FUNCTIONS
include_once("../includes/functions.php");

// $_SESSION['error'] = "no error";
// $_SESSION['message'] = "no message";
// echo "<a href='../test.php'>text.php</a>";



// PAGE HEADER
include_once("../includes/header_admin_new.php");

?>

<?php

if(!isset($_GET['admin'])){
    $redirect = "";
    $redirect .= "<script>
            setTimeout(() => window.location = \"department.php\", 30);
        </script>";
    echo $redirect;
}


    // DECLARING VARIABLE
    $message = "";
    $error = "";
    $input_error = "";

    $dept_name = "";
    $dept_title = "";


// START : VALIDATE FORM AND SEND TO DATABASE
if(isset($_POST['submit'])){

    $dept_name = $_POST['dept_name'];
    $dept_title = $_POST['dept_title'];


    // START : CHECKING FOR INPUT
    $input_error = array();
    if(empty($_POST['dept_name'])){

        $error = "Please fill up all fields";
        $input_error['dept_name'] = "Department name is required.";

    }elseif(!preg_match("/^[a-zA-Z ]*$/", $dept_name)){

        $error = "Please fill up all fields";
        $input_error['dept_name'] = " Department Name can only be in letters.";

    }elseif(preg_match("/^[0-9+]*$/", $dept_name)){

        $error = "Please fill up all fields";
        $input_error['dept_name'] = " Department Name can only be in letters.";

    }elseif(strlen($_POST['dept_name']) < 3 OR strlen($_POST['dept_name']) > 30){

        $error = "Please fill up all fields";
        $input_error['dept_name'] = " Department Name is invalid it should be between 3 to 30 charaters.";
    }
    if(strlen($_POST['dept_title']) < 3 OR strlen($_POST['dept_name']) > 30){

        $error = "Please fill up all fields";
        $input_error['dept_title'] = " Department Title is invalid it should be between 3 to 30 charaters.";
    }
    if(empty($_POST['dept_title'])){

        $error = "Please fill up all fields";
        $input_error['dept_title'] = "Department Title is required.";

    }elseif(!preg_match("/^[a-zA-Z& ]*$/", $dept_title)){

        $error = "Please fill up all fields";
        $input_error['dept_title'] = " Department Title can only be in letters.";
    }
    // END : CHECKING FOR INPUT


    // START PROCESSING INPUT DATA
    if($error == ""){

        $dept_name = strilize_input($dept_name);
        // CHECK IF dept ALREADY ON DATABASE
        // I INTERCHANGE THE VALUES OF THE COLUMN BECAUSE OF ERROR IN DB
        $sql_verify_dept = "SELECT * FROM depertment WHERE dept_title = '{$dept_name}'";
        $result_verfy_dept = mysqli_query($conn, $sql_verify_dept);
        if(mysqli_num_rows($result_verfy_dept) > 0){
            $error = "Error: [ {$dept_name} -- {$dept_title} ] Alredy added.";
        }else{

                // STRILIZE THE USER INPUT BEFORE INSERTING INTO DATABASE
                $dept_name = strtoupper(strilize_input($dept_name));
                $dept_title = strilize_input($dept_title);


            // I INTERCHANGE THE VALUES OF THE COLUMN BECAUSE OF ERROR IN DB
            $sql_input = "INSERT INTO depertment (dept_name, dept_title)
                            VALUES ('$dept_title', '$dept_name')";
            $result_input = mysqli_query($conn, $sql_input);

            $dept_title = html_entity_decode($dept_title);
            $dept_name = html_entity_decode($dept_name);

            if(!$result_input){
                $error = "Error: [ {$dept_name} -- {$dept_title} ] not Added, Please try again!";

            }else{

                $message = "<p>Successful: [ {$dept_name} -- {$dept_title} ] Added...</p>";
                $dept_details = $dept_name;

                $dept_name = "";
                $dept_title = "";

                

                $message .= "<script>
                            setTimeout(() => window.location = \"department.php?message={$dept_details}\", 3000);
                        </script>";
            }
        }

    }
    // END PROCESSING INPUT DATA

}
// END : VALIDATE FORM AND SEND TO DATABASE

?>




<!-- START OF PAGE -->
<div class="page">

    
    <!-- START OF BODY -->
    <div class="w-full text-center px-6">
        <!-- header -->
        <div class="p-3 my-3 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-center text-gray-600">Add Department</h2>
        </div>
        <!-- START OF FORM CONTENT -->
        <div class="p-6 mx-auto my-auto text-left bg-white shadow-lg w-[60%] h-auto m-auto">
            <form action="<?php echo $page_name;?>.php?admin" method="post" id="form">
                    <input type="hidden" name="edited" value="<?php echo $dept_id;?>">
                    <!-- MESSAGE FROM FORM VALIDATION -->
                    <div class="text-xs text-center lex w-full justify-between w-full">
                        <span class="text-xs text-center text-green-400" id="message"><?php echo $message;?></span>
                        <span class="text-xs text-center text-red-400" id="error"><?php echo $error;?></span>
                    </div>

                    <pre>
                        <?php //print_r($input_error);?>
                    </pre>
                    
                    

                    <div class="md:flex w-full justify-center">
                        <!-- ENTER YOUR dept_name  -->
                        <div class="mt-4 md:ml-2">
                            <label class="block" for="Name">Department Name<label>
                                    <input type="text" placeholder="eg: IT"
                                        name="dept_name"
                                        value="<?php echo (isset($dept_name) AND !empty($dept_name))? "{$dept_name}": "";?>"
                                        class="<?php echo (isset($input_error['dept_name']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <?php 
                                        if(isset($input_error['dept_name'])){
                                            $dept_name_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['dept_name']}</span>";
                                            echo $dept_name_error;
                                        }
                                    ?>
                        </div>
                        <!-- ENTER YOUR dept_title  -->
                        <div class="mt-4 md:ml-2">
                            <label class="block" for="dept_title">Department Title<label>
                                    <input type="text" placeholder="eg: Information Technology" id="dept_title"
                                        name="dept_title"
                                        value="<?php echo (isset($dept_title) AND !empty($dept_title))? "{$dept_title}": "";?>"
                                        class="<?php echo (isset($input_error['dept_title']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <?php 
                                        if(isset($input_error['dept_title'])){
                                            $dept_title_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['dept_title']}</span>";
                                            echo $dept_title_error;
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
                        border-[#08a7fd] transition"><i class="fa fa-send m-1 pr-2"></i> Add Department
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
include_once("../includes/footer.php");
?>