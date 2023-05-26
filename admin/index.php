<?php
include_once("../includes/session.php");
include_once("../includes/functions.php");
?>

<?php
// PAGE HEADER
include_once("../includes/header_admin_new.php");



?>




<!-- START PAGE -->
<div class="page">
        <?php
            echo welcome_admin();

        ?>
<!-- START OF DASHBORD CONTAINER -->
<div class="grid mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-100 border-4 border[#08a7fd] w-[100%] lg:w-[90%] mx-auto mt-0">

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 gap-6 xxl:col-span-9">

        <div class="mt-8">
            <div class="flex items-center justify-center h-10 intro-y">
                <div class="text-center">
                    <h2 class="mx-5  text-xl font-medium">DASHBORD</h2>
                </div>
            </div>
            <!-- START OF DASHBORD BOX -->
            <div class="grid grid-cols-12 gap-6 my-5 dashbord">
                <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                    href="staffs.php">
                    <div class="p-5">
                        <div class="flex justify-between text-4xl p-2">
                            <div class="mt-3 font-bold h-7 w-7 text-blue-400 leading-8">
                                <!-- ICON -->
                                <i class="fa fa-users"></i></i>
                            </div>
                            <div class="mt-3 font-bold leading-8">
                                <!-- Number -->
                                <?php echo count(select_all("staffs")); ?>
                            </div>
                        </div>
                            <!-- Name of box -->
                        <div class="w-full text-center break-words my-2 text-3xl lg:text-4xl  
                            font-['Helvetica'] font-normal pt-6 text-gray-600">Staffs
                        </div>
                    </div>
                </a>
                <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                    href="department.php">
                    <div class="p-5">
                        <div class="flex justify-between text-4xl p-2">
                            <div class="mt-3 font-bold h-7 w-7 text-pink-400 leading-8">
                                <!-- ICON -->
                                <i class="fa fa-bars"></i></i>
                            </div>
                            <div class="mt-3 font-bold leading-8">
                                <!-- Number -->
                                <?php echo count(select_all("depertment")); ?>
                            </div>
                        </div>
                            <!-- Name of box -->
                        <div class="w-full text-center break-words my-2 text-3xl lg:text-4xl  
                            font-['Helvetica'] font-normal pt-6 text-gray-600">Departments
                        </div>
                    </div>
                </a>
                <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                    href="courses.php">
                    <div class="p-5">
                        <div class="flex justify-between text-4xl p-2">
                            <div class="mt-3 font-bold h-7 w-7 text-yellow-400 leading-8">
                                <!-- ICON -->
                                <i class="fa fa-book"></i></i>
                            </div>
                            <div class="mt-3 font-bold leading-8">
                                <!-- Number -->
                                <?php echo count(select_all("courses")); ?>
                            </div>
                        </div>
                            <!-- Name of box -->
                        <div class="w-full text-center break-words my-2 text-3xl lg:text-4xl  
                            font-['Helvetica'] font-normal pt-6 text-gray-600">Courses
                        </div>
                    </div>
                </a>

                <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                    href="classroom.php">
                    <div class="p-5">
                        <div class="flex justify-between text-4xl p-2">
                            <div class="mt-3 font-bold h-7 w-7 text-green-400 leading-8">
                                <!-- ICON -->
                                <i class="fa fa-building"></i></i>
                            </div>
                            <div class="mt-3 font-bold leading-8">
                                <!-- Number -->
                                <?php echo count(select_all("classroom")); ?>
                            </div>
                        </div>
                            <!-- Name of box -->
                        <div class="w-full text-center break-words my-2 text-3xl lg:text-4xl  
                            font-['Helvetica'] font-normal pt-6 text-gray-600">Classes
                        </div>
                    </div>
                </a>
            </div>
            <!-- END OF DASHBORD BOX -->
        </div>

    </div>


</div>
<?php
    echo time_table(0);
?>

</div>
<!-- END OF DASHBORD CONTAINER -->

 
</div>
<!-- END OF PAGE -->



<?php
// PAGE FOOTER
include_once("../includes/footer.php");
?>