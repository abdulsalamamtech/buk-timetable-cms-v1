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



if(!isset($_GET['admin'])){
    $redirect .= "<script>
            setTimeout(() => window.location = \"classroom.php\", 30);
        </script>";
    echo $redirect;
}


    // DECLARING VARIABLE
    $message = "";
    $error = "";
    $input_error = "";

    $class_name = "";
    $class_title = "";
    $class_capacity = "";




if(isset($_REQUEST['edit'])){

        $row_name = $_REQUEST['row_name'];
        $row_id = $_REQUEST['row_id'];
        $table_name = $_REQUEST['table_name'];

        // $table_name = "classroom";
        // $column_name = "class_id";
        // $row_id = "3";
        // echo "<pre>"; 
        //     print_r(select_table_item($table_name, $column_name, $row_id));
        // echo "</pre>";

        $column_name = "class_id";
        // $row_id = $row_id;
        $items = select_table_item($table_name, $column_name, $row_id);



        // GET ITEMS FROMDATABASE
        if($items){
            $class_id = $items['class_id'];

            
            $class_name = $items['class_name'];
            $class_title = $items['class_title'];
            $class_capacity = $items['class_capacity'];
        }


}


// START : VALIDATE FORM AND SEND TO DATABASE
if(isset($_POST['submit'])){

    $class_name = $_POST['class_name'];
    $class_title = $_POST['class_title'];
    $class_capacity = $_POST['class_capacity'];

    // class ID
    $class_id = $_POST['edited'];

    // START : CECKING FOR INPUT
    $input_error = array();
    if(empty($_POST['class_name'])){

        $error = "Please fill up all fields";
        $input_error['class_name'] = "class name is required.";

    }elseif(!preg_match("/^[0-9+a-zA-Z-_ ]*$/", $class_name)){
        $error = "Please fill up all fields";
        $input_error['class_name'] = " class Name can only be in letters and numbers.";

    }elseif(strlen($_POST['class_name']) < 3 OR strlen($_POST['class_name']) > 10){
        $error = "Please fill up all fields";
        $input_error['class_name'] = " class Name is invalid it should be between 3 to 10 digit.";
    }else{
        $class_name = strtoupper($class_name);
    }
    if(empty($_POST['class_title'])){

        $error = "Please fill up all fields";
        $input_error['class_title'] = "class Title is required.";

    }elseif(!preg_match("/^[0-9+a-zA-Z ]*$/", $class_title)){
        $error = "Please fill up all fields";
        $input_error['class_title'] = " class Title can only be in letters and numbers.";
    }
    if(empty($class_capacity)){
        $error = "Please fill up all fields";
        $input_error['class_capacity'] = "Class Capacity is required.";
    }
    // END : CECKING FOR INPUT


    // START PROCESSING INPUT DATA
    if($error == ""){

        // STRILIZE THE USER INPUT BEFORE INSERTING INTO DATABASE
        $class_name = strtoupper(strilize_input($class_name));
        $class_title = strilize_input($class_title);
        $class_capacity = strilize_input($class_capacity);

        $class_id = strilize_input($class_id);

        // START : CHECK IF class ALREADY ON DATABASE
        $sql_verify_class = "SELECT * FROM classroom WHERE class_name = '{$class_name}'";
        $result_verfy_class = mysqli_query($conn, $sql_verify_class);
        if(mysqli_num_rows($result_verfy_class) > 1){
            $prev_class = mysqli_fetch_assoc($result_verfy_class);
            $error = "Error: [ {$prev_class['class_name']} -- {$prev_class['class_title']} ] Alredy added.";
        }else{


            $sql_update ="UPDATE classroom SET class_name = '$class_name', 
                class_title = '$class_title', class_capacity = '$class_capacity' 
                WHERE class_id = '$class_id'";

            $sql_update_class = mysqli_query($conn, $sql_update);

            if(!$sql_update_class){
                $error = "Error: [ {$class_name} -- {$class_title} ] not Updated, Please try again!";

            }else{

                $message = "<p>Successful: [ {$class_name} -- {$class_title} ] Updated...</p>";
                $class_details = $class_name;

                $class_id = "";
                $class_name = "";
                $class_title = "";
                $class_capacity = "";

                

                $message .= "<script>
                            setTimeout(() => window.location = \"classroom.php?message={$class_details}\", 3000);
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



<!-- START OF FORM CONTAINER -->
<main>
        
        <!-- START OF BODY -->
        <div class="w-full text-center px-6">
            <!-- header -->
            <div class="p-3 my-3 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-center text-gray-600">Edit Class Room</h2>
            </div>
            <!-- START OF FORM CONTENT -->
            <div class="p-6 mx-auto my-auto text-left bg-white shadow-lg w-[60%] h-auto m-auto">
                <form action="<?php echo $page_name;?>.php?admin" method="post" id="form">
                    <input type="hidden" name="edited" value="<?php echo $class_id;?>">
                    <!-- MESSAGE FROM FORM VALIDATION -->
                    <div class="text-xs text-center lex w-full justify-between w-full">
                        <span class="text-xs text-center text-green-400" id="message"><?php echo $message;?></span>
                        <span class="text-xs text-center text-red-400" id="error"><?php echo $error;?></span>
                    </div>

                    <pre>
                        <?php //print_r($input_error);?>
                    </pre>
                    
                    

                    <div class="md:flex w-full justify-between">
                        <!-- ENTER YOUR class_name  -->
                        <div class="mt-4 md:ml-2">
                            <label class="block" for="Name">Class Name<label>
                                    <input type="text" placeholder="eg: CIT"
                                        name="class_name"
                                        value="<?php echo (isset($class_name) AND !empty($class_name))? "{$class_name}": "";?>"
                                        class="<?php echo (isset($input_error['class_name']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <?php 
                                        if(isset($input_error['class_name'])){
                                            $class_name_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['class_name']}</span>";
                                            echo $class_name_error;
                                        }
                                    ?>
                        </div>
                        <!-- ENTER YOUR class_title  -->
                        <div class="mt-4 md:ml-2">
                            <label class="block" for="class_title">Class Title<label>
                                    <input type="text" placeholder="eg: center for information technology" id="class_title"
                                        name="class_title"
                                        value="<?php echo (isset($class_title) AND !empty($class_title))? "{$class_title}": "";?>"
                                        class="<?php echo (isset($input_error['class_title']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <?php 
                                        if(isset($input_error['class_title'])){
                                            $class_title_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['class_title']}</span>";
                                            echo $class_title_error;
                                        }
                                    ?>
                        </div>

                    </div>  
                    <div class="md:flex w-full justify-between">
                    <!-- ENTER YOUR CLASS CAPACITY -->
                    <div class="mt-4 md:ml-2">
                            <label class="block" for="class_capacity">Class Capacity<label>
                                    <input type="number" placeholder="eg: 320" id="class_capacity"
                                        name="class_capacity"
                                        value="<?php echo (isset($class_capacity) AND !empty($class_capacity))? "{$class_capacity}": "";?>"
                                        class="<?php echo (isset($input_error['class_capacity']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <?php 
                                        // ERROR From input
                                        if(isset($input_error['class_capacity'])){
                                            $class_capacity_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['class_capacity']}</span>";
                                            echo $class_capacity_error;
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
                        border-[#08a7fd] transition"><i class="fa fa-send m-1 pr-2"></i> Update Class
                        </button>
                    </div>
            </form>
        </div>
        <!-- END OF FORM CONTENT -->
    </div>
    <!-- END OF BODY -->
    
</main>
<!-- END OF FORM CONTAINER -->



</div>
<!-- END OF PAGE -->



<?php
// PAGE FOOTER
include_once("../includes/footer.php");
?>