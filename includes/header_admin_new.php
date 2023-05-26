<?php
// CHECK IF ADMIN LOGIN IS SUCESSFUL : ELSE SEND ADMIN BACK TO HOME PAGE
if(empty($_SESSION['admin'])){

  $redirect = "<script>
                  window.location = '../index.php';
              </script>";
  echo $redirect;
  logout_access();
}

?>
<?php

// $page_title= "<h1 class='flex gap-1 items-center mr-2'><img src='../assets/img/buk-logo.png' class='w-10'>TimeTable</h1>";
$page_title= "<img src='../assets/img/buk-logo.png' class='w-16 p-2'>";
$page_title_footer= "BUK TimeTable";
$page_name = pathinfo( $_SERVER['PHP_SELF'], PATHINFO_FILENAME);



$msg = "";

// ADD STAFF MESSAGE
if(isset($_GET['message'])){
    $msg .= "<script>
                alert(\"Admin : ({$_GET['message']}) Sucessfully Added.\");
                setTimeout(() => window.location = \"{$page_name}.php\", 30);
        </script>";
        $_GET['message'] ="";
    echo $msg;
}
// EDIT STAFF
if(isset($_GET['edit'])){
    $msg .= "<script>
                alert(\"Admin : ({$_GET['edit']}) Sucessfully Updated.\");
                setTimeout(() => window.location = \"{$page_name}.php\", 30);
        </script>";
        $_GET['edit'] ="";
    echo $msg;
}
// DELETE STAFF
if(isset($_GET['deleted'])){
    $msg .= "<script>
                alert(\"Admin : ({$_GET['deleted']}) Sucessfully Deleted.\");
                setTimeout(() => window.location = \"{$page_name}.php\", 30);
        </script>";
        $_GET['deleted'] ="";
    echo $msg;
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href=""
      rel="stylesheet"
    />
    <!-- FAVICON -->
    <link rel="shortcut icon" href="../assets/img/buk-logo.png" type="image/x-icon/png">

    <title><?php echo $page_title_footer . " Admin ". $page_name; ?></title>
     <!-- TAILWIND CSS -->
     <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fontawesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- JQUERY  -->
    <!-- <link href="assets/js/jquery-1.10.2.js" rel="stylesheet"/> -->

    <!-- Google	Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'/>


    <!-- STYLE -->
    <link rel="stylesheet" href="../assets/style.css">
  </head>
  <body>
<!-- START OF PAGE -->
<div class="page-container">

   
<!-- HEADER SECTION -->
<header class="sticky top-0 z-30 w-full" id="admin_navbar">
<nav id="header" class="w-full py-1 bg-white shadow-lg mt-0">

         <nav>
            <ul class="text-center m-auto w-full text-[18px]">
                <li>
                    <a class="no-underline" href="index.php">
                        <span class="flex text-center items-center justify-center font-bold">
                            <?php echo $page_title; ?>
                        </span>
                    </a>
                </li>
                <li>
                    <p class="text-center text-bold text-2xl text-[#08a7fd] py-3 px-4 wrap">
                        TIME TABLE MANAGEMENT SYSTEM,  
                        FACULTY OF COMPUTING,
                        BAYERO UNIVERSITY KANO.
                    </p>
                </li>
            </ul>
        </nav>

    
    <!-- START NAVIGATION -->
    <div class="flex-auto flex text-center items-center justify-center font-bold h-auto p-2">
        <!-- NAV LINK FOR LINKS -->
        <div class="flex-auto flex font-bold justify-center items-center p-2">
            <!-- <a href="" class="mx-1 px-4 py-2 text-[#08a7fd]">index</a> -->
            <?php
              echo ($page_name == "index") 
              ? '<a href="index.php"class="mx-1 px-4 py-2 text-[#0266CC] font-bold no-underline">
                <span class="flex gap-2 text-base items-center"><i class="fa fa-bar-chart"></i>Dashboard</span>
              </a>' 
              :'<a href="index.php" class="mx-1 px-4 py-2 text-[#08a7fd] hover:text-[#0266CC]">
                <span class="flex gap-2 text-base items-center"><i class="fa fa-bar-chart"></i>Dashboard</span>
              </a>';
            ?>
            <!-- <a href="" class="mx-1 px-4 py-2 text-[#08a7fd]">Timetable</a> -->
            <?php
              echo ($page_name == "timetable" OR $page_name == "add_timetable" OR $page_name == "edit_timetable") 
              ? '<a href="timetable.php"class="mx-1 px-4 py-2 text-[#0266CC] font-bold no-underline">
              <span class="flex gap-2 text-base items-center"><i class="fa fa-table"></i>Timetable</span>
              </a>' 
              :'<a href="timetable.php" class="mx-1 px-4 py-2 text-[#08a7fd] hover:text-[#0266CC]">
              <span class="flex gap-2 text-base items-center"><i class="fa fa-table"></i>Timetable</span>
              </a>';
            ?>
            
            <!-- <a href="" class="mx-1 px-4 py-2 text-[#08a7fd]">Staff</a> -->
            <?php
              echo ($page_name == "staffs" OR $page_name == "add_staffs" OR $page_name == "edit_staffs") 
              ? '<a href="staffs.php" class="mx-1 px-4 py-2 text-[#0266CC] font-bold no-underline">
              <span class="flex gap-2 text-base items-center"><i class="fa fa-users"></i>Staffs</span>
              </a>' 
              :'<a href="staffs.php" class="mx-1 px-4 py-2 text-[#08a7fd] hover:text-[#0266CC]">
              <span class="flex gap-2 text-base items-center"><i class="fa fa-users"></i>Staffs</span>
              </a>';
            ?>
            <!-- <a href="" class="mx-1 px-4 py-2 text-[#08a7fd]">Department</a> -->
            <?php
              echo ($page_name == "department" OR $page_name == "add_department" OR $page_name == "edit_department") 
              ? '<a href="department.php" class="mx-1 px-4 py-2 text-[#0266CC] font-bold no-underline">
              <span class="flex gap-2 text-base items-center"><i class="fa fa-bars"></i>Departments</span>
              </a>' 
              :'<a href="department.php" class="mx-1 px-4 py-2 text-[#08a7fd] hover:text-[#0266CC]">
              <span class="flex gap-2 text-base items-center"><i class="fa fa-bars"></i>Departments</span>
              </a>';
            ?>
            <!-- <a href="" class="mx-1 px-4 py-2 text-[#08a7fd]">Course</a> -->
            <?php
              echo ($page_name == "courses" OR $page_name == "add_courses" OR $page_name == "edit_courses") 
              ? '<a href="courses.php" class="mx-1 px-4 py-2 text-[#0266CC] font-bold no-underline">
              <span class="flex gap-2 text-base items-center"><i class="fa fa-book"></i>Courses</span>
              </a>' 
              :'<a href="courses.php" class="mx-1 px-4 py-2 text-[#08a7fd] hover:text-[#0266CC]">
              <span class="flex gap-2 text-base items-center"><i class="fa fa-book"></i>Courses</span>
              </a>';
            ?>
            <!-- <a href="" class="mx-1 px-4 py-2 text-[#08a7fd]">Classroom</a> -->
            <?php
              echo ($page_name == "classroom" OR $page_name == "add_classroom" OR $page_name == "edit_classroom") 
              ? '<a href="classroom.php" class="mx-1 px-4 py-2 text-[#0266CC] font-bold no-underline">
              <span class="flex gap-2 text-base items-center"><i class="fa fa-building"></i>Classrooms</span>
              </a>' 
              :'<a href="classroom.php" class="mx-1 px-4 py-2 text-[#08a7fd] hover:text-[#0266CC]">
              <span class="flex gap-2 text-base items-center"><i class="fa fa-building"></i>Classrooms</span>
              </a>';
            ?>
        
            <!-- NAV LINK FOR AND LOGIN -->
            <div class="ml-10">
                <a href="logout.php">
                <button class="text-base mx-2  hover:scale-110 focus:outline-none px-4 py-2 rounded font-bold cursor-pointer
                        hover:bg-[#02669d] 
                        bg-[#08a7fd]
                        text-gray-100 hover:border-[#02669d]
                        border duration-200 ease-in-out 
                        border-[#08a7fd] transition">Logout</button>
                </a>
            </div>

          </div>

        


    </div>
      <!-- END NAVIGATION -->


</nav>
</header>
<!-- HEADER SECTION -->


<!-- END OF PAGE is inside footer -->
