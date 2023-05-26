<?php

// DATABASE CONFIGURATION
include "config.php";





// LOGOUT FUNCTION REDIRECT TO HOME PAGE
function logout_access(){

    $_SESSION['admin'] = false;

    echo '<script>
            function openLocation(){
                window.location="../index.php"
            }
            openLocation();
        </script>';
}





function strilize_input($input_data){
    global$conn;
    $input_data = trim($input_data);
    $input_data = stripslashes($input_data);
    $input_data = htmlentities($input_data);
    $input_data = htmlspecialchars($input_data);
    $input_data = strtolower($input_data);
    $input_data = ucwords($input_data);
    $input_data = mysqli_real_escape_string($conn, $input_data);
    return $input_data;
}




// Get content from database : takes in table name as variable
function select_all($tb_name, $order_by=""){
    global $conn;
    $all_row = array();

    if($order_by !== ""){
        $query = "SELECT * from {$tb_name} ORDER BY {$order_by}";
    }else{
        $query = "SELECT * from {$tb_name}";
    }
    
    $result = mysqli_query($conn, $query);

    if(!$result){
        $error = "Can't get any data, Please try again later...";
    }else{

        while($row = mysqli_fetch_assoc($result)){
            $all_row[] = $row;
        };
        return $all_row;
    }
}




// SELECT SINGLE ROW FROM DATABASE
function select_table_item($table_name, $column_name, $row_id){
    global $conn;
    $error = "";

    $sql = "SELECT * FROM {$table_name} WHERE {$column_name} = '{$row_id}'";
    $query = mysqli_query($conn, $sql);
    if(!$query){
        $error['error'] = "Server Error: Unable to get information";
    }else{
        $result = mysqli_fetch_assoc($query);
    }

    //  print($result);
    return $result;
}





// function insert_into_db($tb_name, $col_name, $val_name){
//     global $conn;
//     // $all_row = array();

//     $query = "INSERT INTO {$tb_name} ({$col_name}) ";
//     $query .= "VALUES ({$col_name})";
//     $result = mysqli_query($conn, $query);

//     if(!$result){
//         $error = "Can't add to {$tb_name}";
//         return $error;
//     }else{
//         $result = "{$tb_name} added succesfully!";
//         return $result;
//     }
// }





// Add Content To DataBase : Uses Global to get the table name
function add_content(){
    global $page_name;
    // concatinating the page name with .php inorder to get the right page
    $add_btn = "";
    $add_btn .= "<div><a href='add_{$page_name}.php?admin=new'>";
    // $add_btn .= "<form action=\"add_{$page_name}.php?admin\" method=\"post\" class='flex justify-center '>";
    // $add_btn .= "<input type=\"hidden\" name=\"add_content\" value=\"{$page_name}\">";
    $add_btn .= '<button type="submit" name="add" id="'. $page_name.'"
                  class="text-base  mx-2  hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                  hover:bg-green-500
                  bg-green-400
                  text-gray-100
                  border duration-200 ease-in-out 
                  border-[#08a7fd] transition">+ Add '.$page_name . '</button>';
    // $add_btn .= "</fom>";
    $add_btn .= "</a></div>";


    echo $add_btn;
}



// Download Content From Database : Uses Global to get the table name
// This is for the admin pages
function download_content(){
    global $page_name;
    $add_btn = "";
    $add_btn .= "<div>";
    $add_btn .= "<form action=\"../download/pdf_download.php\" method=\"post\" class='flex justify-center '>";
    $add_btn .= "<input type='hidden' name='download' value='{$page_name}'>";
    $add_btn .= '<button  type="submit" name="download_pdf" id="'. $page_name.'" class="text-base  mx-2  
                  hover:scale-110 focus:outline-none 
                  flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                  hover:bg-green-500
                  bg-green-400
                  text-gray-100 
                  border duration-200 ease-in-out 
                  border-[#08a7fd] transition"><i class="fa fa-download m-1 pr-2"></i> Download PDF</button>';
    $add_btn .= "</fom>";
    $add_btn .= "</div>";

    echo $add_btn;
}



// Download Content From Database : Uses Global to get the table name
// This is for the home pages
function download_content_pdf(){
    global $page_name;
    $add_btn = "";
    $add_btn .= "<div>";
    $add_btn .= "<form action=\"download/pdf_download.php\" method=\"post\" class='flex justify-center '>";
    $add_btn .= "<input type='hidden' name='download' value='{$page_name}'>";
    $add_btn .= '<button  type="submit" name="download_pdf" id="'. $page_name.'" class="text-base  mx-2  
                  hover:scale-110 focus:outline-none 
                  flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                  hover:bg-green-500
                  bg-green-400
                  text-gray-100 
                  border duration-200 ease-in-out 
                  border-[#08a7fd] transition"><i class="fa fa-download m-1 pr-2"></i> Download PDF</button>';
    $add_btn .= "</fom>";
    $add_btn .= "</div>";

    echo $add_btn;
}





// START OF TIME TABLE
function time_table($edit_delete=true){
    $table_name = "timetable_first_semester";

    $table = '<div class="table-container">
    <div class="middle" style="text-align:center; padding:20px auto;">
        <h2 class="text-center font-bold text-2xl pl-2"> TimeTable </h2>
    </div>
    <table>
    <thead>
        <tr>
            <th>S/N</th>
            <th>Days</th>
            <th>08:00am - 09:00am</th>
            <th>09:00am - 10:00am</th>
            <th>10:00am - 11:00am</th>
            <th>11:00am - 12:00pm</th>
            <th>12:00pm - 01:00pm</th>
            <th>01:00pm - 02:00pm</th>
            <th>02:00pm - 03:00pm</th>
            <th>03:00pm - 04:00pm</th>';
            if($edit_delete){
                $table .= '<th colspan="2" class="text-center">Actions</th>';
            }
        $table .= '
            </tr>
        </thead>
        <tbody>';
$time = select_all($table_name, "id");
$serial_num = 1;
for ($i=0; $i < count($time); $i++) { 
    # code...
    $table .= "<tr>
        <td> ".( $serial_num + $i )."</td>
        <td class='text-left'>{$time[$i]['day']}</td>
        <td class='text-center'>{$time[$i]['time8_9']}  - {$time[$i]['time8_9class']}</td>
        <td class='text-center'>{$time[$i]['time9_10']}  - {$time[$i]['time9_10class']}</td>
        <td class='text-center'>{$time[$i]['time10_11']}  - {$time[$i]['time10_11class']}</td>
        <td class='text-center'>{$time[$i]['time11_12']}  - {$time[$i]['time11_12class']}</td>
        <td class='text-center'>{$time[$i]['time12_1']}  - {$time[$i]['time12_1class']}</td>
        <td class='text-center'>{$time[$i]['time1_2']}  - {$time[$i]['time1_2class']}</td>
        <td class='text-center'>{$time[$i]['time2_3']}  - {$time[$i]['time2_3class']}</td>
        <td class='text-center'>{$time[$i]['time3_4']}  - {$time[$i]['time3_4class']}</td>";
        if($edit_delete){
            $table .= '<td class="">
                    <form action="edit_timetable.php?admin" method="post">
                    <div class="my-0 text-grey-dark">
                        <input type="hidden" name="row_name" value="'.$time[$i]["day"].'">
                        <input type="hidden" name="row_id" value="'.$time[$i]["id"].'">
                        <input type="hidden" name="table_name" value="'. $table_name .'">
                        <button class="w-full text-green-400 text-bold text-xl hover:text-green-600" 
                        type="submit" name="edit"><i class="fa fa-pencil-square-o"></i> Edit</button>
                    </div>
                    </form>
            </td>';
        }
        
    $table .= "</tr> ";
    
}
$table .= '
</tbody>
</table></div>';

return html_entity_decode($table);
}
// END OF TIME TABLE





// START OF STAFF TABLE
function staff_table($edit_delete=false){
    $table_name = "staffs";

    $table = '<div class="table-container">
    <h2 class="text-center font-bold text-2xl pl-2" style="text-align:center; padding:20px auto;">Staffs</h2>
    <table>
    <thead>
        <tr>
            <th>S/N</th>
            <th>Title</th>
            <th>Name</th>
            <th>Rank</th>
            <th>Phone No.</th>
            <th>Email</th>
            <th>Course</th>';
            if($edit_delete){
                $table .= '<th colspan="2" class="text-center">Actions</th>';
            }
    $table .= '
        </tr>
    </thead>
    <tbody>';
$staff = select_all($table_name, "staff_last_name");
$serial_num = 1;
for ($i=0; $i < count($staff); $i++) { 
    # code...
    $table .= "<tr>
        <td> ". ( $serial_num + $i ) ."</td>
        <td>{$staff[$i]['staff_title']}</td>
        <td>{$staff[$i]['staff_last_name']} {$staff[$i]['staff_first_name']} {$staff[$i]['staff_mid_name']}</td>
        <td>{$staff[$i]['rank']}</td>
        <td>{$staff[$i]['staff_phone_number']}</td>
        <td>{$staff[$i]['staff_email']}</td>
        <td>{$staff[$i]['staff_course']}</td>";
        if($edit_delete){
            $table .= '<td>
                    <form action="edit_staffs.php?admin" method="post">
                    <div class="my-0 text-grey-dark">
                        <input type="hidden" name="row_name" value="'.$staff[$i]["staff_title"].'">
                        <input type="hidden" name="row_id" value="'.$staff[$i]["staff_id"].'">
                        <input type="hidden" name="table_name" value="'. $table_name .'">
                        <button class="w-full text-green-400 text-bold text-xl hover:text-green-600" 
                        type="submit" name="edit"><i class="fa fa-pencil-square-o"></i> Edit</button>
                    </div>
                    </form>
            </td>';
            $table .= '<td>
                <form action="delete.php?admin" method="post">
                    <div class="my-0 text-grey-dark">
                    <input type="hidden" name="row_name" value="'.$staff[$i]["staff_email"].'">
                    <input type="hidden" name="row_id" value="'.$staff[$i]["staff_id"].'">
                    <input type="hidden" name="table_name" value="'. $table_name .'">
                    <button class="w-full text-red-400 text-bold text-xl hover:text-red-600" 
                    type="submit" name="delete"><i class="fa fa-trash-o"></i> Delete</button>
                </div>
                </form>
            </td>';
        }
        
    $table .= "</tr> ";
    
}

$table .= '
</tbody>
</table></div>';

return html_entity_decode($table);
}
// END OF STAFF TABLE





// START OF DEPARTMENT TABLE
function dept_table($edit_delete=false){
    $table_name = "depertment";

    $table = '<div class="table-container">
    <h2 class="text-center font-bold text-2xl pl-2" style="text-align:center; padding:20px auto;">Department</h2>
    <table>
    <thead>
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Title</th>';
            if($edit_delete){
                $table .= '<th colspan="2" class="text-center">Actions</th>';
            }
        $table .='</tr>
        </thead>
        <tbody>';
$dept = select_all($table_name, "dept_name");
$serial_num = 1;
for ($i=0; $i < count($dept); $i++) { 
    # code...
    $table .= "<tr>
        <td> ". ( $serial_num + $i )."</td>
        <td>{$dept[$i]['dept_title']}</td>
        <td>{$dept[$i]['dept_name']}</td>";
        if($edit_delete){
            $table .= '<td class="text-blue-600 hover:bg-blue" style="">
                    <form action="edit_department.php?admin" method="post">
                    <div class="my-0 text-grey-dark">
                        <input type="hidden" name="row_name" value="'.$dept[$i]["dept_title"].'">
                        <input type="hidden" name="row_id" value="'.$dept[$i]["dept_id"].'">
                        <input type="hidden" name="table_name" value="'. $table_name .'">
                        <button class="w-full text-green-400 text-bold text-xl hover:text-green-600" 
                        type="submit" name="edit"><i class="fa fa-pencil-square-o"></i> Edit</button>
                    </div>
                    </form>
            </td>';
            $table .= '<td>
                <form action="delete.php?admin" method="post">
                    <div class="my-0 text-grey-dark">
                    <input type="hidden" name="row_name" value="'.$dept[$i]["dept_title"].'">
                    <input type="hidden" name="row_id" value="'.$dept[$i]["dept_id"].'">
                    <input type="hidden" name="table_name" value="'. $table_name .'">
                    <button class="w-full text-red-400 text-bold text-xl hover:text-red-600" 
                    type="submit" name="delete"><i class="fa fa-trash-o"></i> Delete</button>
                </div>
                </form>
            </td>';
        }
        
    $table .= "</tr> ";
    
}
$table .= '
</tbody>
</table></div>';

return html_entity_decode($table);
}
// END OF DEPARTMENT TABLE







// START OF COURSES TABLE
function course_table($edit_delete=false){
    $table_name = "courses";

    $table = '<div class="table-container">
        <h2 class="text-center font-bold text-2xl pl-2" style="text-align:center; padding:20px auto;">Courses</h2>
        <table>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Course Name</th>
                <th>Course Title</th>
                <th>Level</th>
                <th>Credit Unit</th>
                <th>department</th>
                <th>semester</th>';
                if($edit_delete){
                    $table .= '<th colspan="2" class="text-center">Actions</th>';
                }
        $table .= '</tr>
        </thead>
        <tbody>';

    $course = select_all($table_name, "course_name");
    $serial_num = 1;
    for ($i=0; $i < count($course); $i++) { 
        # code...
        $table .= "<tr>
            <td> ". ( $serial_num + $i )."</td>
            <td>{$course[$i]['course_name']}</td>
            <td>{$course[$i]['course_title']}</td>
            <td>{$course[$i]['level']}</td>
            <td>{$course[$i]['credit_unit']}</td>
            <td>{$course[$i]['department']}</td>
            <td>{$course[$i]['semester']}</td>";
            if($edit_delete){
                $table .= '<td class="text-blue-600 hover:bg-blue">
                    <form action="edit_courses.php?admin" method="post">
                    <div class="my-0 text-grey-dark">
                        <input type="hidden" name="row_name" value="'.$course[$i]["course_name"].'">
                        <input type="hidden" name="row_id" value="'.$course[$i]["course_id"].'">
                        <input type="hidden" name="table_name" value="'. $table_name .'">
                        <button class="w-full text-green-400 text-bold text-xl hover:text-green-600" 
                        type="submit" name="edit"><i class="fa fa-pencil-square-o"></i> Edit</button>
                    </div>
                    </form>
                </td>';
                $table .= '<td>
                    <form action="delete.php" method="post">
                    <div class="my-0 text-grey-dark">
                        <input type="hidden" name="row_name" value="'.$course[$i]["course_name"].'">
                        <input type="hidden" name="row_id" value="'.$course[$i]["course_id"].'">
                        <input type="hidden" name="table_name" value="'. $table_name .'">
                        <button class="w-full text-red-400 text-bold text-xl hover:text-red-600" 
                        type="submit" name="delete"><i class="fa fa-trash-o"></i> Delete</button>
                    </div>
                    </form>
                </td>';
            }
        
        $table .= "</tr> ";
    
    }
    $table .= '
    </tbody>
    </table></div>';
    
    return html_entity_decode($table);
}
// END OF COURSES TABLE






// START OF CHECKING WHICH SEMESTER THE COURSE BELONG TO
function check_which_semester($input_semester){
    if($input_semester > 1){
        return "2nd Semester";
    }else{
        return "1st Semester";
    }
}
// END OF CHECKING WHICH SEMESTER THE COURSE BELONG TO





// START OF CLASS ROOM TABLE
function classroom_table($edit_delete=false){
    $table_name = "classroom";
  
    $table = '<div class="table-container">
        <h2 class="text-center font-bold text-2xl pl-2" style="text-align:center; padding:20px auto;">Class Rooms</h2>
        <table>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Class Name</th>
                <th>Class Title</th>
                <th>Capacity</th>';
                if($edit_delete){
                    $table .= '<th colspan="2" class="text-center">Actions</th>';
                }
        $table .='</tr>
        </thead>
        <tbody>';
    $classroom = select_all($table_name, "class_name");
    $serial_num = 1;
    for ($i=0; $i < count($classroom); $i++) { 
        # code...
        $table .= "<tr>
            <td> ". ( $serial_num + $i ) ."</td>
            <td>{$classroom[$i]['class_name']}</td>
            <td>{$classroom[$i]['class_title']}</td>
            <td>{$classroom[$i]['class_capacity']}</td>";
            if($edit_delete){
                $table .= '<td class="text-blue-600 hover:bg-blue">
                    <form action="edit_classroom.php?admin" method="post">
                    <div class="my-0 text-grey-dark">
                        <input type="hidden" name="row_name" value="'.$classroom[$i]["class_name"].'">
                        <input type="hidden" name="row_id" value="'.$classroom[$i]["class_id"].'">
                        <input type="hidden" name="table_name" value="'. $table_name .'">
                        <button class="w-full text-green-400 text-bold text-xl hover:text-green-600" 
                        type="submit" name="edit"><i class="fa fa-pencil-square-o"></i> Edit</button>
                    </div>
                    </form>
                </td>';
                $table .= '<td>
                    <form action="delete.php?admin" method="post">
                    <div class="my-0 text-grey-dark">
                        <input type="hidden" name="row_name" value="'.$classroom[$i]["class_name"].'">
                        <input type="hidden" name="row_id" value="'.$classroom[$i]["class_id"].'">
                        <input type="hidden" name="table_name" value="'. $table_name .'">
                        <button class="w-full text-red-400 text-bold text-xl hover:text-red-600" 
                        type="submit" name="delete"><i class="fa fa-trash-o"></i> Delete</button>
                    </div>
                    </form>
                </td>';
            }
           
        $table .= "</tr> ";
       
    }
    $table .= '
    </tbody>
    </table></div>';
    
    return $table;
    }
// END OF CLASS ROOM TABLE





// START SELECT OPTION FROM DATABASE
function list_option($table_name, $name, $title){
    $list = select_all($table_name, $name);

    $option = "";
    for ($i=0; $i < count($list); $i++) { 
        # code...
        $option .= "<option value=\"{$list[$i][$name]}\">{$list[$i][$name]} -- {$list[$i][$title]}</option>";
    }
    return $option;
}
// END SELECT OPTION FROM DATABASE





// WELCOME MESSAGE FOR ADMIN
function welcome_admin($text="Welcome Admin"){
    $html = '<div class="bg-gradient-to-r from-blue-400 to-indigo-500 p-6 rounded-lg text-center">
                <h2 class="text-3xl font-bold text-white animate-bounce">'
                    . $text.
                '</h2>
            </div>';
    return $html;
}





?>