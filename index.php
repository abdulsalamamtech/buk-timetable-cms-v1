<?php
// PAGE HEADER
include_once("includes/header_new.php");


?>




    <div class="container mx-auto w-full">
        <div class="slider-container">
            <div class="slider text-center text-white m-auto">
                <div class="slide slide1" >
                      <h2>“WELCOME TO BUK, CENTER & HOME OF LEARNING, BAYERO IS OUR CHOICE!”</h2>
                </div>
                <div class="slide slide2">
                      <h2>“FACULTY OF COMPUTING, BAYERO UNIVERSITY KANO, WE ARE THE FUTURE TECH STARS.”</h2>
                </div>
                <div class="slide slide3">
                      <h2>“ABOVE EVERY POSSESSOR OF KNOWLEDGE,
                          THERE IS THE ONE MORE LEARNED.”
                      </h2>
                </div>
            </div>
        </div>
    </div>


<!-- START OF ABOUT SECTION -->
<div class="container mx-auto sm:py-8 md:py-12 h-fill">
  <h2 class="text-3xl font-bold mb-8 mt-10 text-center">About</h2>
  <!-- START OF About container -->
  <div class="flex flex-wrap -mx-4 text-center pt-10 px-10 w-[80%] mx-auto sm:text-xl md:text-2xl">
      <p>
        Scheduling course timetables for a large array of 
        courses is a very complex problem which often has 
        to be solved manually by the center staff even though 
        results are not always fully optimal. Timetabling being 
        a highly constrained combinatorial problem, this work 
        attempts to put into play the effectiveness of evolutionary 
        techniques based on Darwin's theories to solve the 
        timetabling problem if not fully optimal but near optimal
      </p><br>
      <p>
        This study was carried out as to design and develop 
        an Online Timetable Scheduling System that will reduce 
        the intense manual effort being put into creating and 
        developing university timetables. It presents user-friendly 
        features that will familiarize the Staffs and the Student 
        on the application. In addition, it will purvey supplement 
        material in their front desk operation course. The researchers 
        used the HTML & CSS as the front end while PHP & MYSQL as the back end. 
        It provide downloadable PDF of the Timetable, Courses, Departments,
        List of avalable Staffs and the complete information about Lecture/Class rooms.
        This project Provide a proper and better record keeping, Automatic 
        Timetable generation, Lecturers, Courses and Lecture-room registration
      </p>
  </div>

</div>
<!-- START OF ABOUT SECTION -->


<!-- START OF FACULTY SECTION -->
<div class="container mx-auto sm:py-8 md:py-12 h-fill">
  <h2 class="text-3xl font-bold mb-8 text-center">Our Departments</h2>

<!-- START OF CARD container -->
<div class="flex flex-wrap -mx-4 text-center py-10 px-10">
    <!-- START OF CARD -->
    <div class="w-full sm:w-1/2 lg:w-1/4 xl:w-1/4 px-4 mb-4">
      <div class="bg-white rounded-lg shadow-md">
        <img src="https://th.bing.com/th?id=OIP.AMA3RpBw-6T7hMOCGSOMtQHaE8&w=306&h=204&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" alt="Computer Science" class="w-full h-40 object-cover rounded-t-lg">
        <div class="p-4">
          <h3 class="text-lg font-semibold mb-2">Computer Science</h3>
          <p class="text-gray-700 ">Computer Science is the study of computation, 
            information, and automation. Computer science spans theoretical 
            disciplines (such as algorithms) and the design and 
            implementation of hardware and software.</p>
        </div>
      </div>
    </div>
    <div class="w-full sm:w-1/2 lg:w-1/4 xl:w-1/4 px-4 mb-4">
      <div class="bg-white rounded-lg shadow-md">
        <img src="https://th.bing.com/th?id=OIP.OZDWoC8NUTcFPOr4LzQM_QHaFj&w=288&h=216&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" alt="Information Technology" class="w-full h-40 object-cover rounded-t-lg">
        <div class="p-4">
          <h3 class="text-lg font-semibold mb-2">Information Technology</h3>
          <p class="text-gray-700">Information Technology (IT) is the use of computers to create, 
            process, store, retrieve and exchange all kinds of data and information. 
            IT forms part of information and communications technology (ICT).</p>
        </div>
      </div>
    </div>
    <div class="w-full sm:w-1/2 lg:w-1/4 xl:w-1/4 px-4 mb-4">
      <div class="bg-white rounded-lg shadow-md">
        <img src="https://th.bing.com/th?id=OIP.bUmzk4lCeGybsMOqSqL_PQHaEK&w=333&h=187&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" alt="Software Engineering" class="w-full h-40 object-cover rounded-t-lg">
        <div class="p-4">
          <h3 class="text-lg font-semibold mb-2">Software Engineering</h3>
          <p class="text-gray-700">Software Engineering is an engineering-based 
            approach to software development. Thy applies the engineering design process to design, 
            develop, maintain, test, and evaluate computer software.</p>
        </div>
      </div>
    </div>
    <div class="w-full sm:w-1/2 lg:w-1/4 xl:w-1/4 px-4 mb-4">
      <div class="bg-white rounded-lg shadow-md">
        <img src="https://th.bing.com/th?id=OIP.NwzSvGDIQ7f-1Irn_kfAWwHaEo&w=316&h=197&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" alt="Cyber Security" class="w-full h-40 object-cover rounded-t-lg">
        <div class="p-4">
          <h3 class="text-lg font-semibold mb-2">Cyber Security</h3>
          <p class="text-gray-700">Cybersecurity Security comprises directives that 
            safeguard information technology and computer systems with the purpose 
            of forcing organizations to protect their systems and 
            information from cyberattacks.</p>
        </div>
      </div>
    </div>
    <!-- END OF CARD -->
  </div>
<!-- END OF CARD container -->

</div>
<!-- END OF FACULTY SECTION -->




<?php
// PAGE FOOTER
include_once("includes/footer.php");
?>