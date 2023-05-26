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
            setTimeout(() => window.location = \"courses.php\", 30);
        </script>";
    echo $redirect;
}


    // DECLARING VARIABLE
    $message = "";
    $error = "";
    $input_error = "";

    $course_name = "";
    $course_title = "";
    $credit_unit = "0";
    $level = "0";
    $department = "";
    $semester = "";
    $course = "";

// START : VALIDATE FORM AND SEND TO DATABASE
if(isset($_POST['submit'])){

    $department = $_POST['department'];
    $course_name = $_POST['course_name'];
    $course_title = $_POST['course_title'];
    $semester = $_POST['semester'];

    $course = $course_name;
    $course_str = substr($course, 0 , 3);
    $course_num = substr($course, 3);

    // START : CECKING FOR INPUT
    $input_error = array();
    if(empty($_POST['department'])){

        $error = "Please fill up all fields";
        $input_error['department'] = "select a department for the course.";

    }
    if(empty($_POST['course_name'])){

        $error = "Please fill up all fields";
        $input_error['course_name'] = "course name is required.";

    }elseif(!preg_match("/^[0-9+a-zA-Z ]*$/", $course_name)){
        $error = "Please fill up all fields";
        $input_error['course_name'] = " Course Name can only be in letters and numbers.";

    }elseif(strlen($_POST['course_name']) < 7 OR strlen($_POST['course_name']) > 7){
        $error = "Please fill up all fields";
        $input_error['course_name'] = " Course Name is invalid it should be 7 digit.";
    }elseif(strlen($course) !== 7){
        $error = "Please fill up all fields";
        $input_error['course_name'] = " Course Name is invalid it's ". strlen($course) . " characters : it should be 7.";
    }else{
        if(!preg_match("/^[a-zA-Z]*$/", $course_str)){
            $error = "Please fill up all fields";
            $input_error['course_name'] = " Course Name is invalid: The first 3 characters should be in letters";
        }
        if(!preg_match("/^[0-9+]*$/", $course_num)){
            $error = "Please fill up all fields";
            $input_error['course_name'] = " Course Name is invalid";
        }else{
            $lvl = substr($course_num, 0, -3);
            $unit = substr($course_num, 1, -2);
            if($lvl == 0 OR $unit == 0){
                $error = "Please fill up all fields";
                $input_error['course_name'] = " Course Name is invalid: The course level or credit unit can't be 0";
            }else{
                $course_name = strtoupper($course_name);
                $level = $lvl;
                $credit_unit = $unit;
            }
        }
    }
    if(empty($_POST['course_title'])){

        $error = "Please fill up all fields";
        $input_error['course_title'] = "Course Title is required.";

    }elseif(!preg_match("/^[0-9+a-zA-Z ]*$/", $course_title)){
        $error = "Please fill up all fields";
        $input_error['course_title'] = " Course Title can only be in letters and numbers.";
    }
    if(empty($semester)){
        $error = "Please fill up all fields";
        $input_error['semester'] = "select the semester for the course.";
    }
    // END : CECKING FOR INPUT


    // START PROCESSING INPUT DATA
    if($error == ""){

        $course_name = strilize_input($course_name);
        // CHECK IF COURSE ALREADY ON DATABASE
        $sql_verify_staff = "SELECT * FROM courses WHERE course_name = '{$course_name}'";
        $result_verfy_staff = mysqli_query($conn, $sql_verify_staff);
        if(mysqli_num_rows($result_verfy_staff) > 0){
            $error = "Error: [ {$course_name} {$course_title} ] Alredy added.";
        }else{

                // STRILIZE THE USER INPUT BEFORE INSERTING INTO DATABASE
                $course_name = strtoupper(strilize_input($course_name));
                $course_title = strilize_input($course_title);
                $credit_unit = strilize_input($credit_unit);
                $level = strilize_input($level);
                $department = strtoupper(strilize_input($department));
                $semester = strilize_input($semester);


                // $phone_number = strilize_input($phone_number);
                // $course = strilize_input($course);

       

            // $sql_input = "INSERT INTO staffs (department, staff_course_name, staff_course_title, staff_mid_name, staff_email, staff_phone_number, staff_course, semester) 
            //             VALUES ('$department','$course_name','$course_title','$mid_name','$email','$phone_number','$course','$semester')";

            $sql_input = "INSERT INTO courses (course_name, course_title, credit_unit, `level`, department, semester)
                            VALUES ('$course_name', '$course_title', '$credit_unit', '$level', '$department', '$semester')";
            $result_input = mysqli_query($conn, $sql_input);

            if(!$result_input){
                $error = "Error: [ {$course_name} {$course_title} ] not Added, Please try again!";

            }else{

                $message = "<p>Successful: [ {$course_name} {$course_title} ] Added...</p>";
                $staff_details = $course_name;

                $course_name = "";
                $course_title = "";
                $credit_unit = "";
                $level = "";
                $department = "";
                $semester = "";

                

                $message .= "<script>
                            setTimeout(() => window.location = \"courses.php?message={$staff_details}\", 3000);
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
            <h2 class="text-xl font-semibold text-center text-gray-600">Add Course</h2>
        </div>
        <!-- START OF FORM CONTENT -->
        <div class="p-6 mx-auto my-auto text-left bg-white shadow-lg w-[60%] h-auto m-auto">
            <form action="<?php echo $page_name;?>.php?admin" method="post" id="form">
                    <!-- MESSAGE FROM FORM VALIDATION -->
                    <div class="text-xs text-center lex w-full justify-between w-full">
                        <span class="text-xs text-center text-green-400" id="message"><?php echo $message;?></span>
                        <span class="text-xs text-center text-red-400" id="error"><?php echo $error;?></span>
                    </div>

                    <pre>
                        <?php //print_r($input_error);?>
                    </pre>
                    
                    <div class="md:flex w-full justify-between">
                    <!-- ENTER YOUR DEPARTMENT -->
                        <div class="mt-4 md:mr-2">
                            <label class="block" for="Name">Department<label>
                               
                                    <select type="text"
                                        name="department"
                                        
                                        class="<?php echo (isset($input_error['department']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                        
                                        <?php 
                                            if(isset($department) AND !empty($department)){
                                                $department_option = '<option value="'. $department .'">'.$department .'</option>';
                                                echo $department_option;
                                            }else{
                                                echo '<option value="" class="font-normal text-sm">Department e.g (Computer Science.)</option>';
                                            }
                                            // FUNCTION TAKE IN Table Name, Column Name : title, Column Name : name
                                            echo list_option("depertment","dept_title","dept_name");
                                        ?>
                                    </select>
                                    <?php 
                                        if(isset($input_error['department'])){
                                            $department_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['department']}</span>";
                                            echo $department_error;
                                        }
                                    ?>
                        </div>
                        
                        <!-- ENTER YOUR SEMESTER -->
                        <div class="mt-4 md:mr-2">
                            <label class="block" for="staff_semester">Semester<label>
                                    <select type="text" placeholder="semester Title" id="staff_semester"
                                        name="semester"
                                        value="<?php echo (isset($semester) AND !empty($semester))? "{$semester}": "";?>"
                                        class="<?php echo (isset($input_error['semester']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">

                                        <?php 
                                            if(isset($semester) AND !empty($semester)){
                                                $semester_option = '<option value="'. $semester .'">'.check_which_semester($semester) .'</option>';
                                                echo $semester_option;
                                            }else{
                                                echo '<option value="" class="font-normal text-sm">Semester e.g (1st Semester)</option>';
                                            }
                                        ?>
                                        
                                        <option value="1">1st Semester</option>
                                        <option value="2">2nd Semester</option>
                                    </select>
                                    <?php 
                                        if(isset($input_error['semester'])){
                                            $semester_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['semester']}</span>";
                                            echo $semester_error;
                                        }
                                    ?>
                        </div>

                    </div>
                    <div class="md:flex w-full justify-between">
                        <!-- ENTER YOUR course_name  -->
                        <div class="mt-4 md:ml-2">
                            <label class="block" for="Name">Course Name<label>
                                    <input type="text" placeholder="Course Name: CSC4401"
                                        name="course_name"
                                        value="<?php echo (isset($course_name) AND !empty($course_name))? "{$course_name}": "";?>"
                                        class="<?php echo (isset($input_error['course_name']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <?php 
                                        if(isset($input_error['course_name'])){
                                            $course_name_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['course_name']}</span>";
                                            echo $course_name_error;
                                        }
                                    ?>
                        </div>
                        <!-- ENTER YOUR course_title  -->
                        <div class="mt-4 md:ml-2">
                            <label class="block" for="course_title">Course Title<label>
                                    <input type="text" placeholder="Course Title: Data Sructure III" id="course_title"
                                        name="course_title"
                                        value="<?php echo (isset($course_title) AND !empty($course_title))? "{$course_title}": "";?>"
                                        class="<?php echo (isset($input_error['course_title']))? "border-red-400": "";?> w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                                    <?php 
                                        if(isset($input_error['course_title'])){
                                            $course_title_error = "<span class=\"text-xs text-center text-red-400\">{$input_error['course_title']}</span>";
                                            echo $course_title_error;
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
                        border-[#08a7fd] transition"><i class="fa fa-send m-1 pr-2"></i> Add Course
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