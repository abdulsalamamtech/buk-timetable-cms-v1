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




if(isset($_REQUEST['edit'])){

        $row_name = $_REQUEST['row_name'];
        $row_id = $_REQUEST['row_id'];
        $table_name = $_REQUEST['table_name'];

        // $table_name = "deptroom";
        // $column_name = "dept_id";
        // $row_id = "3";
        // echo "<pre>"; 
        //     print_r(select_table_item($table_name, $column_name, $row_id));
        // echo "</pre>";

        $column_name = "dept_id";
        // $row_id = $row_id;
        $items = select_table_item($table_name, $column_name, $row_id);



        // GET ITEMS FROMDATABASE
        if($items){
            $dept_id = $items['dept_id'];

            // I INTERCHANGE THE VALUES OF THE COLUMN BECAUSE OF ERROR IN DB
            $dept_name = html_entity_decode($items['dept_title']);
            $dept_title = html_entity_decode($items['dept_name']);
        }


}


// START : VALIDATE FORM AND SEND TO DATABASE
if(isset($_POST['submit'])){

    $dept_name = $_POST['dept_name'];
    $dept_title = $_POST['dept_title'];

        // Department ID
        $dept_id = $_POST['edited'];

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

        // STRILIZE THE USER INPUT BEFORE INSERTING INTO DATABASE
        $dept_name = strtoupper(strilize_input($dept_name));
        $dept_title = strilize_input($dept_title);

        $dept_id = strilize_input($dept_id);

        // START : CHECK IF dept ALREADY ON DATABASE
        // I INTERCHANGE THE VALUES OF THE COLUMN BECAUSE OF ERROR IN DB
        $sql_verify_dept = "SELECT * FROM depertment WHERE dept_title = '{$dept_name}'";
        $result_verfy_dept = mysqli_query($conn, $sql_verify_dept);
        if(mysqli_num_rows($result_verfy_dept) > 1){
            $prev_dept = mysqli_fetch_assoc($result_verfy_dept);
            $error = "Error: [ {$prev_dept['dept_name']} -- {$prev_dept['dept_title']} ] Alredy added.";
        }else{


            // I INTERCHANGE THE VALUES OF THE COLUMN BECAUSE OF ERROR IN DB
            $sql_update ="UPDATE depertment SET dept_title = '$dept_name', 
                dept_name = '$dept_title' WHERE dept_id = '$dept_id'";

            $sql_update_dept = mysqli_query($conn, $sql_update);

            $dept_title = html_entity_decode($dept_title);
            $dept_name = html_entity_decode($dept_name);

            if(!$sql_update_dept){

                $error = "Error: [ {$dept_name} -- {$dept_title} ] not Updated, Please try again!";

            }else{

                $message = "<p>Successful: [ {$dept_name} -- {$dept_title} ] Updated...</p>";
                $dept_details = $dept_name;

                $dept_id = "";
                $dept_name = "";
                $dept_title = "";
                $dept_capacity = "";

                

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
            <h2 class="text-xl font-semibold text-center text-gray-600">Edit Department</h2>
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
                        border-[#08a7fd] transition"><i class="fa fa-send m-1 pr-2"></i> Update Department
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