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
            setTimeout(() => window.location = \"staffs.php\", 30);
        </script>";
    echo $redirect;
}


    // DECLARING VARIABLE
    $message = "";
    $error = "";
    $input_error = "";

    $staff_title = "";
    $first_name = "";
    $last_name = "";
    $mid_name = "";
    $rank = "";
    $email = "";
    $phone_number = "";
    $course = "";

    // STAFF ID
    $staff_id = "";




if(isset($_REQUEST['edit'])){

        $row_name = $_REQUEST['row_name'];
        $row_id = $_REQUEST['row_id'];
        $table_name = $_REQUEST['table_name'];

        // $table_name = "staffs";
        // $column_name = "staff_id";
        // $row_id = "3";
        // echo "<pre>"; 
        //     print_r(select_table_item($table_name, $column_name, $row_id));
        // echo "</pre>";

        // $table_name = $table_name;
        $column_name = "staff_id";
        // $row_id = $row_id;
        $items = select_table_item($table_name, $column_name, $row_id);



        // GET ITEMS FROMDATABASE
        if($items){
            $staff_id = $items['staff_id'];

            $staff_title = $items['staff_title'];
            $first_name = $items['staff_first_name'];
            $last_name = $items['staff_last_name'];
            $mid_name = $items['staff_mid_name'];
            $rank = $items['rank'];
            $email = $items['staff_email'];
            $phone_number = $items['staff_phone_number'];
            $course = $items['staff_course'];
        }


}

// START : VALIDATE FORM AND SEND TO DATABASE
if(isset($_POST['submit'])){


    $staff_title = $_POST['staff_title'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mid_name = $_POST['mid_name'];
    $rank = $_POST['rank'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $course = $_POST['course'];

    // STAFF ID
    $staff_id = $_POST['edited'];

    // START : CECKING FOR INPUT
    $input_error = array();
    if(empty($_POST['staff_title'])){

        $error = "Please fill up all fields";
        $input_error['title'] = "select a title for the staff.";

    }
    if(empty($_POST['first_name'])){

        $error = "Please fill up all fields";
        $input_error['first_name'] = "first name is required.";

    }elseif(!preg_match("/^[a-zA-Z. ]*$/", $first_name)){
        $error = "Please fill up all fields";
        $input_error['first_name'] = " Name can only be letters.";
    }
    if(empty($_POST['last_name'])){

        $error = "Please fill up all fields";
        $input_error['last_name'] = "last name is required.";

    }elseif(!preg_match("/^[a-zA-Z. ]*$/", $last_name)){
        $error = "Please fill up all fields";
        $input_error['last_name'] = " Name can only be letters.";
    }
    if(!preg_match("/^[a-zA-Z. ]*$/", $mid_name)){
        $error = "Please fill up all fields";
        $input_error['mid_name'] = " Name can only be letters.";
    }
    if(empty($_POST['rank'])){

        $error = "Please fill up all fields";
        $input_error['rank'] = "select a rank for the staff.";

    }
    if(empty($_POST['email'])){

        $error = "Please fill up all fields";
        $input_error['email'] = "email is required.";

    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Please fill up all fields";
        $input_error['email'] = "please enter a valid email address";
    }
    if(empty($_POST['phone_number'])){

        $error = "Please fill up all fields";
        $input_error['phone_number'] = "phone number is required.";

    }elseif(strlen($_POST['phone_number']) < 10 OR strlen($_POST['phone_number']) > 15){
        $error = "Please fill up all fields";
        $input_error['phone_number'] = "please enter a valid phone number";
    }

    if(empty($_POST['course'])){

        $error = "Please fill up all fields";
        $input_error['course'] = "select a course for the staff.";

    }
    // END : CECKING FOR INPUT


    // START PROCESSING INPUT DATA
    if($error == ""){

                // STRILIZE THE USER INPUT BEFORE INSERTING INTO DATABASE
                $staff_title = strilize_input($staff_title);
                $first_name = strilize_input($first_name);
                $last_name = strilize_input($last_name);
                $mid_name = strilize_input($mid_name);
                $rank = strilize_input($rank);
                $email = strtolower(strilize_input($email));
                $phone_number = strilize_input($phone_number);
                $course = strtoupper(strilize_input($course));
                
                $staff_id = strilize_input($staff_id);

            // START  : CHECK IF STAFF ALREADY ON DATABASE
            $sql_verify_staff = "SELECT * FROM staffs WHERE staff_email = '{$email}'";
            $result_verfy_staff = mysqli_query($conn, $sql_verify_staff);
            if(mysqli_num_rows($result_verfy_staff) > 1){
                $prev_staff = mysqli_fetch_assoc($result_verfy_staff);
                $error = "Error: [ {$prev_staff['staff_first_name']} {$prev_staff['staff_last_name']} ] alredy have an account with this email=> ({$email})";
            }else{
              
                $sql_update = "UPDATE `staffs` SET `staff_title` = '$staff_title', 
                            `staff_first_name` = '$first_name', `staff_last_name` = '$last_name', 
                            `staff_mid_name` = '$mid_name', `staff_email` = '$email', 
                            `staff_phone_number` = '$phone_number', `staff_course` = '$course', 
                            `rank` = '$rank' WHERE `staffs`.`staff_id` = '{$staff_id}';";
                $sql_update_result = mysqli_query($conn, $sql_update);

                if(!$sql_update_result){
                    $error = "Error: {$first_name} with email=> ({$email}) not updated, Please try again!";
                }else{

                    $message = "<p>Successful: {$first_name} with email=> ({$email}) Updated...</p>";
                    $staff_details = $email;
                    $staff_title = "";
                    $first_name = "";
                    $last_name = "";
                    $mid_name = "";
                    $rank = "";
                    $email = "";
                    $phone_number = "";
                    $course = "";
                    $message .= "<script>
                                setTimeout(() => window.location = \"staffs.php?edit={$staff_details}\", 2000);
                            </script>";
                }
            }
            // END : CHECK IF STAFF ALREADY ON DATABASE

        }

    }
    // END PROCESSING INPUT DATA

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
            <h2 class="text-xl font-semibold text-center text-gray-600">Edit Staff</h2>
        </div>
        <!-- START OF FORM CONTENT -->
        <div class="p-6 mx-auto my-auto text-left bg-white shadow-lg w-[98%] h-[98%] m-auto">
            <form action="<?php echo $page_name;?>.php?admin" method="post" id="form">

            <input type="hidden" name="edited" value="<?php echo $staff_id;?>">
                    <!-- MESSAGE FROM FORM VALIDATION -->
                    <div class="text-xs text-center lex w-full justify-between w-full">
                        <span class="text-xs text-center text-green-400" id="message"><?php echo $message;?></span>
                        <span class="text-xs text-center text-red-400" id="error"><?php echo $error;?></span>
                    </div>

                    <pre>
                        <?php //print_r($input_error);?>
                    </pre>
                    
                    <div class="md:flex w-full justify-between">
                    <!-- ENTER YOUR TITLE -->
                        <div class="mt-4 md:mr-2">
                            <label class="block" for="Name">Title<label>
                               
                                    <select type="text"
                                        name="staff_title"
                                        
                                        class="<?php echo (isset($input_error['title']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                        
                                        <?php 
                                            if(isset($staff_title) AND !empty($staff_title)){
                                                $staff_title_option = '<option value="'. $staff_title .'">'.$staff_title .'</option>';
                                                echo $staff_title_option;
                                            }else{
                                                echo '<option value="" class="font-normal text-sm">Staff Title e.g (Dr.)</option>';
                                            }
                                        ?>
                                        
                                        <option value="Prof.">Prof.</option>
                                        <option value="Dr.">Dr.</option>
                                        <option value="Mr.">Mr.</option>
                                        <option value="Mrs.">Mrs.</option>
                                        <option value="Miss.">Miss.</option>
                                        <option value="Mallam.">Mallam.</option>
                                        <option value="Mallama.">Mallama.</option>
                                        <option value="Alhaji.">Alhaji.</option>
                                        <option value="Hajiah.">Hajiah.</option>
                                    </select>
                                    <?php 
                                        if(isset($input_error['title'])){
                                            $staff_title_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['title']}</span>";
                                            echo $staff_title_error;
                                        }
                                    ?>
                        </div>
                        <!-- ENTER YOUR first_name  -->
                        <div class="mt-4 md:ml-2">
                            <label class="block" for="Name">First Name<label>
                                    <input type="text" placeholder="First Name"
                                        name="first_name"
                                        value="<?php echo (isset($first_name) AND !empty($first_name))? "{$first_name}": "";?>"
                                        class="<?php echo (isset($input_error['first_name']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <?php 
                                        if(isset($input_error['first_name'])){
                                            $first_name_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['first_name']}</span>";
                                            echo $first_name_error;
                                        }
                                    ?>
                        </div>
                        <!-- ENTER YOUR last_name  -->
                        <div class="mt-4 md:ml-2">
                            <label class="block" for="last_name">Last Name<label>
                                    <input type="text" placeholder="Last Name" id="last_name"
                                        name="last_name"
                                        value="<?php echo (isset($last_name) AND !empty($last_name))? "{$last_name}": "";?>"
                                        class="<?php echo (isset($input_error['last_name']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <?php 
                                        if(isset($input_error['last_name'])){
                                            $last_name_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['last_name']}</span>";
                                            echo $last_name_error;
                                        }
                                    ?>
                        </div>
                        <!-- ENTER YOUR mid_name  -->
                        <div class="mt-4 md:ml-2">
                            <label class="block" for="mid_name">Middle Name<label>
                                    <input type="text" placeholder="Middle Name" id="mid_name"
                                        name="mid_name"
                                        value="<?php echo (isset($mid_name) AND !empty($mid_name))? "{$mid_name}": "";?>"
                                        class="<?php echo (isset($input_error['mid_name']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                        <?php 
                                        if(isset($input_error['mid_name'])){
                                            $mid_name_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['mid_name']}</span>";
                                            echo $mid_name_error;
                                        }
                                    ?>
                        </div>
                    </div>
                    <div class="md:flex w-full justify-between">
                    <!-- ENTER YOUR grade -->
                        <div class="mt-4 md:mr-2">
                            <label class="block" for="staff_rank">Rank<label>
                                    <select type="text" placeholder="Rank Title" id="staff_rank"
                                        name="rank"
                                        value="<?php echo (isset($rank) AND !empty($rank))? "{$rank}": "";?>"
                                        class="<?php echo (isset($input_error['rank']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">

                                        <?php 
                                            if(isset($rank) AND !empty($rank)){
                                                $rank_option = '<option value="'. $rank .'">'.$rank .'</option>';
                                                echo $rank_option;
                                            }else{
                                                echo '<option value="" class="font-normal text-sm">Staff Rank Title e.g (Proffesor)</option>';
                                            }
                                        ?>
                                        
                                        <option value="Proffesor">Proffesor</option>
                                        <option value="Reader/Associate Prof.">Reader/Associate Prof.</option>
                                        <option value="Senir Lecturer">Senior Lecturer</option>
                                        <option value="Lecturer III">Lecturer III</option>
                                        <option value="Lecturer II">Lecturer II</option>
                                        <option value="Lecturer I">Lecturer I</option>
                                        <option value="Assistant Lecturer">Assistant Lecturer</option>
                                        <option value="Graduate Lecturer">Graduate Lecturer</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <?php 
                                        if(isset($input_error['rank'])){
                                            $rank_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['rank']}</span>";
                                            echo $rank_error;
                                        }
                                    ?>
                        </div>
                        <!-- ENTER YOUR email  -->
                        <div class="mt-4 md:ml-2">
                            <label class="block" for="email">Email Address<label>
                                    <input type="email" placeholder="Email Address" id="email"
                                        name="email"
                                        value="<?php echo (isset($email) AND !empty($email))? "{$email}": "";?>"
                                        class="<?php echo (isset($input_error['email']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <?php 
                                        if(isset($input_error['email'])){
                                            $rank_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['email']}</span>";
                                            echo $rank_error;
                                        }
                                    ?>
                        </div>
                        <!-- ENTER YOUR PHONE NUMBER -->
                        <div class="mt-4 md:ml-2">
                            <label class="block" for="phone_number">Phone Number<label>
                                    <input type="tel" placeholder="Phone Number" id="phone_number"
                                        name="phone_number"
                                        value="<?php echo (isset($phone_number) AND !empty($phone_number))? "{$phone_number}": "";?>"
                                        class="<?php echo (isset($input_error['phone_number']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <?php 
                                        // ERROR From input
                                        if(isset($input_error['phone_number'])){
                                            $phone_number_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['phone_number']}</span>";
                                            echo $phone_number_error;
                                        }
                                    ?>
                        </div>
                    </div>
                    <!-- ENTER YOUR Courses  -->
                    <div class="mt-4">
                        <label class="block" for="course">Course<label>
                                    <select type="text" placeholder="Courses" id="course"
                                        name="course"
                                        class="<?php echo (isset($input_error['course']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                        <?php 
                                            
                                            if(isset($course) AND !empty($course)){
                                                $course_option = '<option value="'. $course .'">'.$course .'</option>';
                                                echo $course_option;
                                            }else{
                                                echo '<option value="" class="font-normal text-sm">Course e.g (MTH4311)</option>';
                                            }
                                            echo '<option value=" - " class="font-normal text-sm">None</option>';
                                            // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                                            echo list_option("courses","course_name","course_title");
                                        ?>

                                        <!-- <option value="MTH4311">MTH4311 <span>Elementory Mathematics III</span></option>
                                        <option value="MTH4311">CST4301 <span>Data Structure III</span></option>
                                        <option value="MTH4311">CBS4211 <span>Cyber Security Practice II</span></option> -->
                                    </select>
                                    <?php 
                                        // ERROR From input
                                        if(isset($input_error['course'])){
                                            $course_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['course']}</span>";
                                            echo $course_error;
                                        }
                                    ?>
                    </div>
                    <div class="flex items-center justify-center h-10 intro-y my-6">
                        <button id="send_form" 
                        name="submit"
                        class="text-base mx-2  hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                        hover:bg-[#02669d] 
                        bg-[#08a7fd]
                        text-gray-100 hover:border-[#02669d]
                        border duration-200 ease-in-out 
                        border-[#08a7fd] transition"><i class="fa fa-send m-1 pr-2"></i> Update Staffs
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