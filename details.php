<?php
// PAGE HEADER
include_once("includes/header_new.php");
?>


<!-- START OF PAGE -->
<div class="page">
<style>
main{
    width: 90%;
    margin: 0 auto;
    height: fit-content;
}
.image-box{
    margin: 0 auto;
    text-align: center;
}
img{
    width: 100%;
    height: 100%;
    max-width: 1000px;
}
</style>


<?php

// require 'vendor/autoload.php';

// use PhpOffice\PhpWord\IOFactory;

// $word_file_dir = "files/BUK_TIMETABLE_MANAGEMENT_SYSTEM.docx";
// $word_file_dir = "C:/Users/Lenovo/Downloads/buk-timetable_images/BUK-TIMETABLE-MANAGEMENT-SYSTEM.pdf";
// // Load the .docx file
// $phpWord = IOFactory::load($word_file_dir);

// // Save the .docx file as HTML
// $htmlFilePath = 'files/file.html';
// $phpWord->save($htmlFilePath, 'HTML');


// $htmlContent = file_get_contents('files/file.html');
// echo $htmlContent;


// $page = "<div class=\"grid mb-4 pb-10 px-8 mx-4 rounded-3xl leading-normal 
//         bg-gray-100 border-4 border[#08a7fd] w-[90%] mx-auto\">
//         <div style='padding:10px'>
//             {$htmlContent}
//         </div></div>";
// echo $page;
?>
<div class="grid mb-4 pb-10 px-8 mx-4 rounded-3xl leading-normal 
     bg-gray-100 border-4 border[#08a7fd] w-[90%] h-[100%] mx-auto">
     
        <main class="image-box flex items-center justify-center gap-4 flex-wrap">
            <img src="assets/img/details_one.jpeg" alt="">
            <img src="assets/img/details_two.jpeg" alt="">
        </main>

</div>




</div>
<!-- END OF PAGE -->


<?php
// PAGE FOOTER
include_once("includes/footer.php");
?>