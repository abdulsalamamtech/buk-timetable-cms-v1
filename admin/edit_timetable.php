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


// EDIT TIME TABLE
if(!isset($_GET['admin'])){
    $redirect .= "<script>
            setTimeout(() => window.location = \"timetable.php\", 30);
        </script>";
    echo $redirect;
}


    // DECLARING VARIABLE
    $message = "";
    $error = "";
    $input_error = "";


    // 8_9 COURSE AND CLASS
    $time8_9course = "";
    $time8_9class = "";
    // 9_10 COURSE AND CLASS
    $time9_10course = "";
    $time9_10class = "";
    // 10_11COURSE AND CLASS
    $time10_11course = "";
    $time10_11class = "";
    // 11_12 COURSE AND CLASS
    $time11_12course = "";
    $time11_12class = "";
    // 12_1 COURSE AND CLASS
    $time12_1course = "";
    $time12_1class = "";
    // 1_2 COURSE AND CLASS
    $time1_2course = "";
    $time1_2class = "";
    // 2_3 COURSE AND CLASS
    $time2_3course = "";
    $time2_3class = "";
    // 3_4 COURSE AND CLASS
    $time3_4course = "";
    $time3_4class = "";


// timetable day  ID
// $timetable_day_id = "1";
// $timetable_day = "Monday";
// $table_name_for_timetable = "timetable_first_semester";
// $column_id = "id";


if(isset($_REQUEST['edit'])){

        $row_name = $_REQUEST['row_name'];
        $row_id = $_REQUEST['row_id'];
        $table_name = $_REQUEST['table_name'];

        // $table_name = "timetable_first_semester";
        // $column_id = "id";
        // $row_id = "1";
        // $timetable_day = $row_name;

        
        $column_id = "id";
        $timetable_day = $row_name;
        $items = select_table_item($table_name, $column_id, $row_id);
        // echo "<pre>"; 
            // print_r(select_table_item($table_name, $column_id, $row_id));
        // echo "</pre>";

        // GET ITEMS FROMDATABASE
        if($items){

                // timetable day  ID
                $timetable_day_id = $items['id'];
                // timetable day
                $timetable_day = $items['day'];

            // 8_9 COURSE AND CLASS
            $time8_9course = $items['time8_9'];
            $time8_9class = $items['time8_9class'];
            // 9_10 COURSE AND CLASS
            $time9_10course = $items['time9_10'];
            $time9_10class = $items['time9_10class'];
            // 10_11COURSE AND CLASS
            $time10_11course = $items['time10_11'];
            $time10_11class = $items['time10_11class'];
            // 11_12 COURSE AND CLASS
            $time11_12course = $items['time11_12'];
            $time11_12class = $items['time11_12class'];
            // 12_1 COURSE AND CLASS
            $time12_1course = $items['time12_1'];
            $time12_1class = $items['time12_1class'];
            // 1_2 COURSE AND CLASS
            $time1_2course = $items['time1_2'];
            $time1_2class = $items['time1_2class'];
            // 2_3 COURSE AND CLASS
            $time2_3course = $items['time2_3'];
            $time2_3class = $items['time2_3class'];
            // 3_4 COURSE AND CLASS
            $time3_4course = $items['time3_4'];
            $time3_4class = $items['time3_4class'];

            // 4_5 COURSE AND CLASS
            // $time4_5course = $items['time4_5'];
            // $time4_5class = $items['time4_5class'];
        }


}

// START : VALIDATE FORM AND SEND TO DATABASE
if(isset($_POST['submit'])){

    // 8_9 COURSE AND CLASS
    $time8_9course = $_POST['time8_9course'];
    $time8_9class = $_POST['time8_9class'];
    // 9_10 COURSE AND CLASS
    $time9_10course = $_POST['time9_10course'];
    $time9_10class = $_POST['time9_10class'];
    // 10_11COURSE AND CLASS
    $time10_11course = $_POST['time10_11course'];
    $time10_11class = $_POST['time10_11class'];
    // 11_12 COURSE AND CLASS
    $time11_12course = $_POST['time11_12course'];
    $time11_12class = $_POST['time11_12class'];
    // 12_1 COURSE AND CLASS
    $time12_1course = $_POST['time12_1course'];
    $time12_1class = $_POST['time12_1class'];
    // 1_2 COURSE AND CLASS
    $time1_2course = $_POST['time1_2course'];
    $time1_2class = $_POST['time1_2class'];
    // 2_3 COURSE AND CLASS
    $time2_3course = $_POST['time2_3course'];
    $time2_3class = $_POST['time2_3class'];
    // 3_4 COURSE AND CLASS
    $time3_4course = $_POST['time3_4course'];
    $time3_4class = $_POST['time3_4class'];

    // timetable day  ID
    $timetable_day_id = $_POST['edited'];
    // timetable day
    $timetable_day = $_POST['edited_day'];

    // START : CECKING FOR INPUT
    $input_error = array();
    $error = "";
    // 8_9 COURSE AND CLASS
    if(!empty($time8_9course) AND empty($time8_9class)){
        $input_error['time8_9course'] = "Class Room is required for {$time8_9course}";
        $input_error['time8_9class'] = "choose a Class";
        $error = "Please fill in all field";
    }
    if(empty($time8_9course) AND !empty($time8_9class)){
        $time8_9class = "";
    }
    // 9_10 COURSE AND CLASS
    if(!empty($time9_10course) AND empty($time9_10class)){
        $input_error['time9_10course'] = "Class Room is required for {$time9_10course}";
        $input_error['time9_10class'] = "choose a Class";
        $error = "Please fill in all field";
    }
    if(empty($time9_10course) AND !empty($time9_10class)){
        $time9_10class = "";
    }
    // 10_11 COURSE AND CLASS
    if(!empty($time10_11course) AND empty($time10_11class)){
        $input_error['time10_11course'] = "Class Room is required for {$time10_11course}";
        $input_error['time10_11class'] = "choose a Class";
        $error = "Please fill in all field";
    }
    if(empty($time10_11course) AND !empty($time10_11class)){
        $time10_11class = "";
    }
    // 11_12 COURSE AND CLASS
    if(!empty($time11_12course) AND empty($time11_12class)){
        $input_error['time11_12course'] = "Class Room is required for {$time11_12course}";
        $input_error['time11_12class'] = "choose a Class";
        $error = "Please fill in all field";
    }
    if(empty($time11_12course) AND !empty($time11_12class)){
        $time11_12class = "";
    }
    // 12_1 COURSE AND CLASS
    if(!empty($time12_1course) AND empty($time12_1class)){
        $input_error['time12_1course'] = "Class Room is required for {$time12_1course}";
        $input_error['time12_1class'] = "choose a Class";
        $error = "Please fill in all field";
    }
    if(empty($time12_1course) AND !empty($time12_1class)){
        $time12_1class = "";
    }
    // 1_2 COURSE AND CLASS
    if(!empty($time1_2course) AND empty($time1_2class)){
        $input_error['time1_2course'] = "Class Room is required for {$time1_2course}";
        $input_error['time1_2class'] = "choose a Class";
        $error = "Please fill in all field";
    }
    if(empty($time1_2course) AND !empty($time1_2class)){
        $time1_2class = "";
    }
    // 2_3 COURSE AND CLASS
    if(!empty($time2_3course) AND empty($time2_3class)){
        $input_error['time2_3course'] = "Class Room is required for {$time2_3course}";
        $input_error['time2_3class'] = "choose a Class";
        $error = "Please fill in all field";
    }
    if(empty($time2_3course) AND !empty($time2_3class)){
        $time2_3class = "";
    }
    // 3_4 COURSE AND CLASS
    if(!empty($time3_4course) AND empty($time3_4class)){
        $input_error['time3_4course'] = "Class Room is required for {$time3_4course}";
        $input_error['time3_4class'] = "choose a Class";
        $error = "Please fill in all field";
    }
    if(empty($time3_4course) AND !empty($time3_4class)){
        $time3_4class = "";
    }
    // END : CECKING FOR INPUT



    // START PROCESSING INPUT DATA
    if($error == ""){

        // STRILIZE THE USER INPUT BEFORE INSERTING INTO DATABASE
        // 8_9 COURSE AND CLASS
        $time8_9course = strtoupper(strilize_input($time8_9course));
        $time8_9class = strtoupper(strilize_input($time8_9class));
        // 9_10 COURSE AND CLASS
        $time9_10course = strtoupper(strilize_input($time9_10course));
        $time9_10class = strtoupper(strilize_input($time9_10class));
        // 10_11COURSE AND CLASS
        $time10_11course = strtoupper(strilize_input($time10_11course));
        $time10_11class = strtoupper(strilize_input($time10_11class));
        // 11_12 COURSE AND CLASS
        $time11_12course = strtoupper(strilize_input($time11_12course));
        $time11_12class = strtoupper(strilize_input($time11_12class));
        // 12_1 COURSE AND CLASS
        $time12_1course = strtoupper(strilize_input($time12_1course));
        $time12_1class = strtoupper(strilize_input($time12_1class));
        // 1_2 COURSE AND CLASS
        $time1_2course = strtoupper(strilize_input($time1_2course));
        $time1_2class = strtoupper(strilize_input($time1_2class));
        // 2_3 COURSE AND CLASS
        $time2_3course = strtoupper(strilize_input($time2_3course));
        $time2_3class = strtoupper(strilize_input($time2_3class));
        // 3_4 COURSE AND CLASS
        $time3_4course = strtoupper(strilize_input($time3_4course));
        $time3_4class = strtoupper(strilize_input($time3_4class));
                
            
            $timetable_day_id = strtoupper(strilize_input($timetable_day_id));
            $timetable_day = strtoupper(strilize_input($timetable_day));

            // START  : CHECK IF time8_9 ALREADY ON DATABASE
            // $sql_verify_timetable = "SELECT * FROM {$table_name} WHERE `day` = '{$timetable_day}'";
            // $result_verfy_timetable = mysqli_query($conn, $sql_verify_timetable);
            // if(mysqli_num_rows($result_verfy_timetable) > 1){
            //     $prev_timetable = mysqli_fetch_assoc($result_verfy_timetable);
            //     $error = "Error: [ {$prev_timetable['day']} Course and Class timetable alredy Added.";
            // }else
            if(isset($timetable_day)){
              
                $sql_update = "UPDATE `timetable_first_semester` SET `time8_9` = '{$time8_9course}', 
                    `time8_9class` = '{$time8_9class}', `time9_10` = '{$time9_10course}', `time9_10class` = '{$time9_10class}', 
                    `time10_11` = '{$time10_11course}', `time10_11class` = '{$time10_11class}', `time11_12` = '{$time11_12course}', 
                    `time11_12class` = '{$time11_12class}', `time12_1` = '{$time12_1course}', `time12_1class` = '{$time12_1class}', 
                    `time1_2` = '{$time1_2course}', `time1_2class` = '{$time1_2class}', `time2_3` = '{$time2_3course}', 
                    `time2_3class` = '{$time2_3class}', `time3_4` = '{$time3_4course}', `time3_4class` = '{$time3_4class}' 
                    WHERE `timetable_first_semester`.`id` = '{$timetable_day_id}';";

                $sql_update_result = mysqli_query($conn, $sql_update);

                if(!$sql_update_result){
                    $error = "Error: {$timetable_day} not updated, Please try again!";
                }else{

                    $message = "<p>Successful: {$timetable_day} Updated...</p>";
                    $timetable_day_details = $timetable_day;
                    // 8_9 COURSE AND CLASS
                    $time8_9course = "";
                    $time8_9class = "";
                    // 9_10 COURSE AND CLASS
                    $time9_10course = "";
                    $time9_10class = "";
                    // 10_11COURSE AND CLASS
                    $time10_11course = "";
                    $time10_11class = "";
                    // 11_12 COURSE AND CLASS
                    $time11_12course = "";
                    $time11_12class = "";
                    // 12_1 COURSE AND CLASS
                    $time12_1course = "";
                    $time12_1class = "";
                    // 1_2 COURSE AND CLASS
                    $time1_2course = "";
                    $time1_2class = "";
                    // 2_3 COURSE AND CLASS
                    $time2_3course = "";
                    $time2_3class = "";
                    // 3_4 COURSE AND CLASS
                    $time3_4course = "";
                    $time3_4class = "";
                    $message .= "<script>
                                setTimeout(() => window.location = \"timetable.php?edit={$timetable_day_details}\", 2000);
                            </script>";
                }
            }
            // END : CHECK IF time8_9 ALREADY ON DATABASE

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
<div class="w-full text-center px-6 w-[98%] md:w-[80%] h-[98%] md:h-auto m-auto">

    <!-- header -->
    <div class="p-3 my-3 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-center text-gray-600">Edit <?php echo $timetable_day; ?> Time Table</h2>
    </div>
<!-- START OF FORM CONTENT -->
<div class="p-6 mx-auto my-auto text-left bg-white shadow-lg w-[98%] h-[98%] m-auto">
    <form action="<?php echo $page_name;?>.php?admin" method="post" id="form">

        <input type="hidden" name="edited" value="<?php echo $timetable_day_id;?>">
        <input type="hidden" name="edited_day" value="<?php echo $timetable_day;?>">
        <!-- MESSAGE FROM FORM VALIDATION -->
        <div class="text-xs text-center lex w-full justify-between w-full">
            <span class="text-xs text-center text-green-400" id="message"><?php echo $message;?></span>
            <span class="text-xs text-center text-red-400" id="error"><?php echo $error;?></span>
        </div>

        <pre>
            <?php //print_r($input_error);?>
        </pre>
        
    
        <div class="md:flex w-full justify-center md:gap-8 intro-y font-bold text-xl text-center">
            <div class="mt-4 md:mr-2 w-[20%]">Time</div>
            <div class="mt-4 md:mr-2 w-[30%]">Course</div>
            <div class="mt-4 md:mr-2 w-[30%]">Class Room</div>
        </div>
        <!-- TIME8_9 TIME TABLE -->
        <div class="md:flex w-full justify-center md:gap-8 intro-y">
                <!-- ENTER YOUR Time -->
                <div class="mt-4 md:mr-2 w-[20%]">
                    <!-- <label class="block text-center md:text-left w-full" for="time8_9">Time<label> -->
                        <div class="text-xl text-center text-gray-400  w-full px-4 py-2 mt-2" id="time8_9">08:00am - 09:00am</div>
                </div>
                <!-- ENTER YOUR Course-->
                <div class="mt-4 md:mr-2 w-[30%]">
                    <!-- <label class="block" for="time8_9course">Course<label> -->
                        
                            <select type="text"
                                name="time8_9course"
                                id="time8_9course"
                                class="<?php echo (isset($input_error['time8_9course']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                
                                <?php 
                                    if(isset($time8_9course) AND !empty($time8_9course)){
                                        $time8_9_course_option = '<option value="'. $time8_9course .'">'.$time8_9course .'</option>';
                                        echo $time8_9_course_option;
                                    }
                                    echo '<option value="" class="font-normal text-sm">Free</option>';

                                    // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                                    echo list_option("courses","course_name","course_title");
                                ?>
                            </select>
                            <?php 
                                if(isset($input_error['time8_9course'])){
                                    $time8_9_course_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time8_9course']}</span>";
                                    echo $time8_9_course_error;
                                }
                            ?>
                </div>

                <!-- ENTER YOUR class -->
                <div class="mt-4 md:mr-2 w-[30%]">
                    <!-- <label class="block" for="time8_9class">Class Room<label> -->
                        
                            <select type="text"
                                name="time8_9class"
                                id="time8_9class"
                                class="<?php echo (isset($input_error['time8_9class']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                
                                <?php 
                                    if(isset($time8_9class) AND !empty($time8_9class)){
                                        $time8_9class_option = '<option value="'. $time8_9class .'">'.$time8_9class .'</option>';
                                        echo $time8_9class_option;
                                    }
                                    echo '<option value="" class="font-normal text-sm">Free</option>';
                                    // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                                    echo list_option("classroom","class_name","class_title");
                                ?>
                            </select>
                            <?php 
                                if(isset($input_error['time8_9class'])){
                                    $time8_9_class_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time8_9class']}</span>";
                                    echo $time8_9_class_error;
                                }
                            ?>
                </div>
        </div>

        <!-- TIME9_10 TIME TABLE -->
        <div class="md:flex w-full justify-center md:gap-8 intro-y">
                <!-- ENTER YOUR Time -->
                <div class="mt-4 md:mr-2 w-[20%]">
                    <!-- <label class="block text-center md:text-left w-full" for="time9_10">Time<label> -->
                        <div class="text-xl text-center text-gray-400  w-full px-4 py-2 mt-2" id="time9_10">09:00am - 10:00am</div>
                </div>
                <!-- ENTER YOUR Course-->
                <div class="mt-4 md:mr-2 w-[30%]">
                    <!-- <label class="block" for="time9_10course">Course<label> -->
                        
                            <select type="text"
                                name="time9_10course"
                                id="time9_10course"
                                class="<?php echo (isset($input_error['time9_10course']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                
                                <?php 
                                    if(isset($time9_10course) AND !empty($time9_10course)){
                                        $time9_10_course_option = '<option value="'. $time9_10course .'">'.$time9_10course .'</option>';
                                        echo $time9_10_course_option;
                                    }
                                    echo '<option value="" class="font-normal text-sm">Free</option>';
                                    // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                                    echo list_option("courses","course_name","course_title");
                                ?>
                            </select>
                            <?php 
                                if(isset($input_error['time9_10course'])){
                                    $time9_10_course_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time9_10course']}</span>";
                                    echo $time9_10_course_error;
                                }
                            ?>
                </div>

                <!-- ENTER YOUR class -->
                <div class="mt-4 md:mr-2 w-[30%]">
                    <!-- <label class="block" for="time9_10class">Class Room<label> -->
                        
                            <select type="text"
                                name="time9_10class"
                                id="time9_10class"
                                class="<?php echo (isset($input_error['time9_10class']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                
                                <?php 
                                    if(isset($time9_10class) AND !empty($time9_10class)){
                                        $time9_10class_option = '<option value="'. $time9_10class .'">'.$time9_10class .'</option>';
                                        echo $time9_10class_option;
                                    }
                                    echo '<option value="" class="font-normal text-sm">Free</option>';
                                    // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                                    echo list_option("classroom","class_name","class_title");
                                ?>
                            </select>
                            <?php 
                                if(isset($input_error['time9_10class'])){
                                    $time9_10_class_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time9_10class']}</span>";
                                    echo $time9_10_class_error;
                                }
                            ?>
                </div>
        </div>

        <!-- TIME10_11 TIME TABLE -->
        <div class="md:flex w-full justify-center md:gap-8 intro-y">
                <!-- ENTER YOUR Time -->
                <div class="mt-4 md:mr-2 w-[20%]">
                    <!-- <label class="block text-center md:text-left w-full" for="time10_11">Time<label> -->
                        <div class="text-xl text-center text-gray-400  w-full px-4 py-2 mt-2" id="time10_11">10:00am - 11:00am</div>
                </div>
                <!-- ENTER YOUR Course-->
                <div class="mt-4 md:mr-2 w-[30%]">
                    <!-- <label class="block" for="time10_11course">Course<label> -->
                        
                            <select type="text"
                                name="time10_11course"
                                id="time10_11course"
                                class="<?php echo (isset($input_error['time10_11course']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                
                                <?php 
                                    if(isset($time10_11course) AND !empty($time10_11course)){
                                        $time10_11_course_option = '<option value="'. $time10_11course .'">'.$time10_11course .'</option>';
                                        echo $time10_11_course_option;
                                    }
                                    echo '<option value="" class="font-normal text-sm">Free</option>';
                                    // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                                    echo list_option("courses","course_name","course_title");
                                ?>
                            </select>
                            <?php 
                                if(isset($input_error['time10_11course'])){
                                    $time10_11_course_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time10_11course']}</span>";
                                    echo $time10_11_course_error;
                                }
                            ?>
                </div>

                <!-- ENTER YOUR class -->
                <div class="mt-4 md:mr-2 w-[30%]">
                    <!-- <label class="block" for="time10_11class">Class Room<label> -->
                        
                            <select type="text"
                                name="time10_11class"
                                id="time10_11class"
                                class="<?php echo (isset($input_error['time10_11class']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                
                                <?php 
                                    if(isset($time10_11class) AND !empty($time10_11class)){
                                        $time10_11class_option = '<option value="'. $time10_11class .'">'.$time10_11class .'</option>';
                                        echo $time10_11class_option;
                                    }
                                    echo '<option value="" class="font-normal text-sm">Free</option>';
                                    // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                                    echo list_option("classroom","class_name","class_title");
                                ?>
                            </select>
                            <?php 
                                if(isset($input_error['time10_11class'])){
                                    $time10_11_class_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time10_11class']}</span>";
                                    echo $time10_11_class_error;
                                }
                            ?>
                </div>
        </div>

        <!-- TIME11_12 TIME TABLE -->
        <div class="md:flex w-full justify-center md:gap-8 intro-y">
                <!-- ENTER YOUR Time -->
                <div class="mt-4 md:mr-2 w-[20%]">
                    <!-- <label class="block text-center md:text-left w-full" for="time11_12">Time<label> -->
                        <div class="text-xl text-center text-gray-400  w-full px-4 py-2 mt-2 " id="time11_12">11:00am - 12:00pm</div>
                </div>
                <!-- ENTER YOUR Course-->
                <div class="mt-4 md:mr-2 w-[30%]">
                    <!-- <label class="block" for="time11_12course">Course<label> -->
                        
                            <select type="text"
                                name="time11_12course"
                                id="time11_12course"
                                class="<?php echo (isset($input_error['time11_12course']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                
                                <?php 
                                    if(isset($time11_12course) AND !empty($time11_12course)){
                                        $time11_12_course_option = '<option value="'. $time11_12course .'">'.$time11_12course .'</option>';
                                        echo $time11_12_course_option;
                                    }
                                    echo '<option value="" class="font-normal text-sm">Free</option>';
                                    // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                                    echo list_option("courses","course_name","course_title");
                                ?>
                            </select>
                            <?php 
                                if(isset($input_error['time11_12course'])){
                                    $time11_12_course_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time11_12course']}</span>";
                                    echo $time11_12_course_error;
                                }
                            ?>
                </div>

                <!-- ENTER YOUR class -->
                <div class="mt-4 md:mr-2 w-[30%]">
                    <!-- <label class="block" for="time11_12class">Class Room<label> -->
                        
                            <select type="text"
                                name="time11_12class"
                                id="time11_12class"
                                class="<?php echo (isset($input_error['time11_12class']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                
                                <?php 
                                    if(isset($time11_12class) AND !empty($time11_12class)){
                                        $time11_12class_option = '<option value="'. $time11_12class .'">'.$time11_12class .'</option>';
                                        echo $time11_12class_option;
                                    }
                                    echo '<option value="" class="font-normal text-sm">Free</option>';
                                    // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                                    echo list_option("classroom","class_name","class_title");
                                ?>
                            </select>
                            <?php 
                                if(isset($input_error['time11_12class'])){
                                    $time11_12_class_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time11_12class']}</span>";
                                    echo $time11_12_class_error;
                                }
                            ?>
                </div>
        </div>

        <!-- TIME12_1 TIME TABLE -->
        <div class="md:flex w-full justify-center md:gap-8 intro-y">
            <!-- ENTER YOUR Time -->
            <div class="mt-4 md:mr-2 w-[20%]">
                <!-- <label class="block text-center md:text-left w-full" for="time12_1">Time<label> -->
                    <div class="text-xl text-center text-gray-400  w-full px-4 py-2 mt-2 " id="time12_1">12:00pm - 1:00pm</div>
            </div>
            <!-- ENTER YOUR Course-->
            <div class="mt-4 md:mr-2 w-[30%]">
                <!-- <label class="block" for="time12_1course">Course<label> -->
                    
                        <select type="text"
                            name="time12_1course"
                            id="time12_1course"
                            class="<?php echo (isset($input_error['time12_1course']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                            
                            <?php
                            
                                if(isset($time12_1course) AND !empty($time12_1course)){
                                    $time12_1_course_option = '<option value="'. $time12_1course .'">'.$time12_1course .'</option>';
                                    echo $time12_1_course_option;
                                }
                                echo '<option value="" class="font-normal text-sm">Free</option>';
                                // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                                echo list_option("courses","course_name","course_title");
                            ?>
                        </select>
                        <?php 
                            if(isset($input_error['time12_1course'])){
                                $time12_1_course_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time12_1course']}</span>";
                                echo $time12_1_course_error;
                            }
                        ?>
            </div>

            <!-- ENTER YOUR class -->
            <div class="mt-4 md:mr-2 w-[30%]">
            <!-- <label class="block" for="time12_1class">Class Room<label> -->
                
                    <select type="text"
                        name="time12_1class"
                        id="time12_1class"
                        class="<?php echo (isset($input_error['time12_1class']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                        
                        <?php 

                            if(isset($time12_1class) AND !empty($time12_1class)){
                                $time12_1class_option = '<option value="'. $time12_1class .'">'.$time12_1class .'</option>';
                                echo $time12_1class_option;
                            }
                            echo '<option value="" class="font-normal text-sm">Free</option>';
                            // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                            echo list_option("classroom","class_name","class_title");
                        ?>
                    </select>
                    <?php 
                        if(isset($input_error['time12_1class'])){
                            $time12_1_class_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time12_1class']}</span>";
                            echo $time12_1_class_error;
                        }
                    ?>
        </div>
        </div>

        <!-- TIME1_2 TIME TABLE -->
        <div class="md:flex w-full justify-center md:gap-8 intro-y">
            <!-- ENTER YOUR Time -->
            <div class="mt-4 md:mr-2 w-[20%]">
                <!-- <label class="block text-center md:text-left w-full" for="time1_2">Time<label> -->
                    <div class="text-xl text-center text-gray-400  w-full px-4 py-2 mt-2" id="time1_2">1:00pm - 2:00pm</div>
            </div>
            <!-- ENTER YOUR Course-->
            <div class="mt-4 md:mr-2 w-[30%]">
                <!-- <label class="block" for="time1_2course">Course<label> -->
                    
                        <select type="text"
                            name="time1_2course"
                            id="time1_2course"
                            class="<?php echo (isset($input_error['time1_2course']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                            
                            <?php

                                if(isset($time1_2course) AND !empty($time1_2course)){
                                    $time1_2_course_option = '<option value="'. $time1_2course .'">'.$time1_2course .'</option>';
                                    echo $time1_2_course_option;
                                }
                                echo '<option value="" class="font-normal text-sm">Free</option>';
                                // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                                echo list_option("courses","course_name","course_title");
                            ?>
                        </select>
                        <?php 
                            if(isset($input_error['time1_2course'])){
                                $time1_2_course_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time1_2course']}</span>";
                                echo $time1_2_course_error;
                            }
                        ?>
            </div>

            <!-- ENTER YOUR class -->
            <div class="mt-4 md:mr-2 w-[30%]">
            <!-- <label class="block" for="time1_2class">Class Room<label> -->
                
                    <select type="text"
                        name="time1_2class"
                        id="time1_2class"
                        class="<?php echo (isset($input_error['time1_2class']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                        
                        <?php

                            if(isset($time1_2class) AND !empty($time1_2class)){
                                $time1_2class_option = '<option value="'. $time1_2class .'">'.$time1_2class .'</option>';
                                echo $time1_2class_option;
                            }
                            echo '<option value="" class="font-normal text-sm">Free</option>';
                            // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                            echo list_option("classroom","class_name","class_title");
                        ?>
                    </select>
                    <?php 
                        if(isset($input_error['time1_2class'])){
                            $time1_2_class_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time1_2class']}</span>";
                            echo $time1_2_class_error;
                        }
                    ?>
        </div>
        </div>

        <!-- TIME2_3 TIME TABLE -->
        <div class="md:flex w-full justify-center md:gap-8 intro-y">
            <!-- ENTER YOUR Time -->
            <div class="mt-4 md:mr-2 w-[20%]">
                <!-- <label class="block text-center md:text-left w-full" for="time2_3">Time<label> -->
                    <div class="text-xl text-center text-gray-400  w-full px-4 py-2 mt-2 " id="time2_3">2:00pm - 3:00pm</div>
            </div>
            <!-- ENTER YOUR Course-->
            <div class="mt-4 md:mr-2 w-[30%]">
                <!-- <label class="block" for="time2_3course">Course<label> -->
                    
                        <select type="text"
                            name="time2_3course"
                            id="time2_3course"
                            class="<?php echo (isset($input_error['time2_3course']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                            
                            <?php 
                                
                                if(isset($time2_3course) AND !empty($time2_3course)){
                                    $time2_3_course_option = '<option value="'. $time2_3course .'">'.$time2_3course .'</option>';
                                    echo $time2_3_course_option;
                                }
                                echo '<option value="" class="font-normal text-sm">Free</option>';
                                // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                                echo list_option("courses","course_name","course_title");
                            ?>
                        </select>
                        <?php 
                            if(isset($input_error['time2_3course'])){
                                $time2_3_course_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time2_3course']}</span>";
                                echo $time2_3_course_error;
                            }
                        ?>
            </div>

            <!-- ENTER YOUR class -->
            <div class="mt-4 md:mr-2 w-[30%]">
            <!-- <label class="block" for="time2_3class">Class Room<label> -->
                
                    <select type="text"
                        name="time2_3class"
                        id="time2_3class"
                        class="<?php echo (isset($input_error['time2_3class']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                        
                        <?php 

                            if(isset($time2_3class) AND !empty($time2_3class)){
                                $time2_3class_option = '<option value="'. $time2_3class .'">'.$time2_3class .'</option>';
                                echo $time2_3class_option;
                            }
                            echo '<option value="" class="font-normal text-sm">Free</option>';
                            // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                            echo list_option("classroom","class_name","class_title");
                        ?>
                    </select>
                    <?php 
                        if(isset($input_error['time2_3class'])){
                            $time2_3_class_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time2_3class']}</span>";
                            echo $time2_3_class_error;
                        }
                    ?>
        </div>
        </div>

        <!-- TIME3_4 TIME TABLE -->
        <div class="md:flex w-full justify-center md:gap-8 intro-y">
            <!-- ENTER YOUR Time -->
            <div class="mt-4 md:mr-2 w-[20%]">
                <!-- <label class="block text-center md:text-left w-full" for="time3_4">Time<label> -->
                    <div class="text-xl text-center text-gray-400  w-full px-4 py-2 mt-2" id="time3_4">3:00pm - 4:00pm</div>
            </div>
            <!-- ENTER YOUR Course-->
            <div class="mt-4 md:mr-2 w-[30%]">
                <!-- <label class="block" for="time3_4course">Course<label> -->
                    
                        <select type="text"
                            name="time3_4course"
                            id="time3_4course"
                            class="<?php echo (isset($input_error['time3_4course']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                            
                            <?php 
                                if(isset($time3_4course) AND !empty($time3_4course)){
                                    $time3_4_course_option = '<option value="'. $time3_4course .'">'.$time3_4course .'</option>';
                                    echo $time3_4_course_option;
                                }
                                echo '<option value="" class="font-normal text-sm">Free</option>';
                                // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                                echo list_option("courses","course_name","course_title");
                            ?>
                        </select>
                        <?php 
                            if(isset($input_error['time3_4course'])){
                                $time3_4_course_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time3_4course']}</span>";
                                echo $time3_4_course_error;
                            }
                        ?>
            </div>

            <!-- ENTER YOUR class -->
            <div class="mt-4 md:mr-2 w-[30%]">
            <!-- <label class="block" for="time3_4class">Class Room<label> -->
                
                    <select type="text"
                        name="time3_4class"
                        id="time3_4class"
                        class="<?php echo (isset($input_error['time3_4class']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                        
                        <?php 

                            if(isset($time3_4class) AND !empty($time3_4class)){
                                $time3_4class_option = '<option value="'. $time3_4class .'">'.$time3_4class .'</option>';
                                echo $time3_4class_option;
                            }
                            echo '<option value="" class="font-normal text-sm">Free</option>';
                            // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                            echo list_option("classroom","class_name","class_title");

                        ?>
                    </select>
                    <?php 
                        if(isset($input_error['time3_4class'])){
                            $time3_4_class_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['time3_4class']}</span>";
                            echo $time3_4_class_error;
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
                        border-[#08a7fd] transition"><i class="fa fa-send m-1 pr-2"></i> Update <?php echo $timetable_day; ?> Time Table
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