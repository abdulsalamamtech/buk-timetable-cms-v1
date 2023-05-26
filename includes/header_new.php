<?php
$page_title= "<img src='assets/img/buk-logo.png' class='w-16 p-2'>";
$page_title_footer= "BUK TimeTable";
$page_name = pathinfo( $_SERVER['PHP_SELF'], PATHINFO_FILENAME);

// FUNCTIONS
include_once("includes/functions.php");


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
    <link rel="shortcut icon" href="assets/img/buk-logo.png" type="image/png">

    <title><?php echo $page_title_footer; ?></title>
     <!-- TAILWIND CSS -->
     <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fontawesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Google	Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'/>

    <!-- STYLE -->
    <link rel="stylesheet" href="assets\style.css">

  </head>
  <body>
    
<!-- START OF PAGE -->
<div class="page">

<!-- CSS STYLES -->
<style>
body{
    height: 100%;
    width: 100%;
}

.page{
  min-width: 1020px;
  max-width: 2000px;
  margin: 0 auto;
  padding: 0;
}

header{
  width: 100%;
  min-width: 1000px;
  position: sticky;
  left: 0;
  right: 0;
}

nav, table{
  width: 100%;
  width: 100%;
  position: relative;
  left: 0;
  right: 0;
  top: 0;
}

.page-container{
    border: 1px solid #dddddd;
    width: 100%;
    margin: 0 auto;
    max-width:1800px;
    min-width:1000px;
    padding-bottom: 20px;
    margin: 0 auto;
    width: 100%;
  }

  a:hover{
    text-decoration: none;
  }

    .table-container{
        padding:20px;
        margin: 0 auto;
        width: 90%;
        position:relative;
    }
    table {
        margin: 0 auto;
        margin-top: 20px;
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 2px solid #dddddd;
        text-align: center;
        padding: 8px;
    }
    td{
      text-align: left;
    }

    tr:nth-child(even) {
        background-color: #ffffff;
    }

    tr:nth-child(odd) {
        background-color: #f4f4f4;
    }


/* SLIDER CONTAINERS */
.container{
  width: 100%;
  min-width:1000px;
  max-width:1800px;
}

.slider-container {
  width: 100%;
  margin: 0 auto;
  height: 75vh;
  overflow: hidden;
  background-blend-mode: darken;
  background-color: rgba(0, 0, 0.7, 0.7);
  object-fit: cover;
}

.slider {
  display: flex;
  width: 100%;
  height: 100%;
  margin: 0 auto;
  transition: transform 0.3s ease-in-out;
}

.slide {
  flex: 0 0 100%;
  width: 100%;
  height: 100%;
  text-align: center;
  font-size: 20px;
  padding: 0px;
  box-sizing: border-box;
}

.slide{
  background-blend-mode: darken;
  background-color: rgba(0, 0, 0.7, 0.7);
  object-fit: cover;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  width: 100%;
  color: white;
}

.slide1{
  background-image: url("assets/img/buk-senate-building.png");
}
.slide2{
  background-image: url("assets/img/buk-compressed.png");
}
.slide3{
  background-image: url("assets/img/buk-roundabout.jpg");
}

.slide{
  display: grid;
  place-items: center;
  text-align: center;
  color: white;
  width: 100%;
}
.slide h2{
  font-size: 300%;
  padding: 0px 50px;
}
nav span .fa{
  font-size: 15px;
}
</style>
   
<!-- HEADER SECTION -->
<header class="sticky top-0 z-30 w-full">
<nav id="header" class="w-full py-1 bg-white shadow-lg mt-auto">
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
        <!-- NAV LINK FOR LINKS -->
          <div class="flex-auto flex text-center items-center justify-center font-bold h-auto p-2">
            <!-- <a href="" class="mx-1 px-4 py-2 text-[#08a7fd]">index</a> -->
            <?php
              echo ($page_name == "index") 
              ? '<a href="index.php"class="mx-1 px-4 py-2 text-[#0266cc] font-bold no-underline">
                  <span class="flex gap-2 text-base items-center"><i class="fa fa-user"></i>Home</span>
              </a>' 
              :'<a href="index.php" class="mx-1 px-4 py-2 text-[#08a7fd] hover:text-[#0266CC]">
                <span class="flex gap-2 text-base items-center"><i class="fa fa-user"></i>Home</span>
              </a>';
            ?>
            <!-- <a href="" class="mx-1 px-4 py-2 text-[#08a7fd]">Timetable</a> -->
            <?php
              echo ($page_name == "timetable") 
              ? '<a href="timetable.php"class="mx-1 px-4 py-2 text-[#0266CC] font-bold no-underline">
                <span class="flex gap-2 text-base items-center"><i class="fa fa-table"></i>Timetable</span>
              </a>' 
              :'<a href="timetable.php" class="mx-1 px-4 py-2 text-[#08a7fd] hover:text-[#0266CC]">
                <span class="flex gap-2 text-base items-center"><i class="fa fa-table"></i>Timetable</span>
              </a>';
            ?>
            
            <!-- <a href="" class="mx-1 px-4 py-2 text-[#08a7fd]">Staff</a> -->
            <?php
              echo ($page_name == "staffs") 
              ? '<a href="staffs.php" class="mx-1 px-4 py-2 text-[#0266CC] font-bold no-underline">
              <span class="flex gap-2 text-base items-center"><i class="fa fa-users"></i>Staffs</span>
              </a>' 
              :'<a href="staffs.php" class="mx-1 px-4 py-2 text-[#08a7fd] hover:text-[#0266CC]">
                <span class="flex gap-2 text-base items-center"><i class="fa fa-users"></i>Staffs</span>
              </a>';
            ?>
            <!-- <a href="" class="mx-1 px-4 py-2 text-[#08a7fd]">Department</a> -->
            <?php
              echo ($page_name == "department") 
              ? '<a href="department.php" class="mx-1 px-4 py-2 text-[#0266CC] font-bold no-underline">
                <span class="flex gap-2 text-base items-center"><i class="fa fa-bars"></i>Departments</span>
                </a>' 
              :'<a href="department.php" class="mx-1 px-4 py-2 text-[#08a7fd] hover:text-[#0266CC]">
                <span class="flex gap-2 text-base items-center"><i class="fa fa-bars"></i>Departments</span>
              </a>';
            ?>
            <!-- <a href="" class="mx-1 px-4 py-2 text-[#08a7fd]">Course</a> -->
            <?php
              echo ($page_name == "courses") 
              ? '<a href="courses.php" class="mx-1 px-4 py-2 text-[#0266CC] font-bold no-underline">
              <span class="flex gap-2 text-base items-center"><i class="fa fa-book"></i>Courses</span>
              </a>' 
              :'<a href="courses.php" class="mx-1 px-4 py-2 text-[#08a7fd] hover:text-[#0266CC]">
                <span class="flex gap-2 text-base items-center"><i class="fa fa-book"></i>Courses</span>
              </a>';
            ?>
            <!-- <a href="" class="mx-1 px-4 py-2 text-[#08a7fd]">Classroom</a> -->
            <?php
              echo ($page_name == "classroom") 
              ? '<a href="classroom.php" class="mx-1 px-4 py-2 text-[#0266CC] font-bold no-underline">
              <span class="flex gap-2 text-base items-center"><i class="fa fa-building"></i>Classrooms</span>
              </a>' 
              :'<a href="classroom.php" class="mx-1 px-4 py-2 text-[#08a7fd] hover:text-[#0266CC]">
              <span class="flex gap-2 text-base items-center"><i class="fa fa-building"></i>Classrooms</span>
              </a>';
            ?>
            <!-- <a href="details.php" class="mx-1 px-4 py-2 text-[#08a7fd]">Details</a> -->
            <?php
              echo ($page_name == "details") 
              ? '<a href="details.php" class="mx-1 px-4 py-2 text-[#0266CC] font-bold no-underline">
                <span class="flex gap-2 text-base items-center"><i class="fa fa-info-circle"></i>Details</span>
              </a>' 
              :'<a href="details.php" class="mx-1 px-4 py-2 text-[#08a7fd] hover:text-[#0266CC]">
                <span class="flex gap-2 text-base items-center"><i class="fa fa-info-circle"></i>Details</span>
              </a>';
            ?>
            <!-- <a href="admin.php" class="mx-1 px-4 py-2 text-[#08a7fd] font-bold cursor-pointer">Admin</a> -->
            <?php
              echo ($page_name == "admin") 
              ? '<a href="admin.php" class="mx-1 px-4 py-2 text-[#0266CC] font-bold no-underline">
                <span class="flex gap-2 text-base items-center"><i class="fa fa-rocket"></i>Admin</span>
                </a>' 
              :'<a href="admin.php" class="mx-1 px-4 py-2 text-[#08a7fd] hover:text-[#0266CC]">
                <span class="flex gap-2 text-base items-center"><i class="fa fa-rocket"></i>Admin</span>
                </a>';
            ?>
          </div>
        <!-- START NAVIGATION -->
        <!-- NAV LINK FOR LINKS -->

</nav>
</header>
<!-- HEADER SECTION -->




<!-- END OF PAGE is inside footer -->
