<?php

// VENDOR AUTOLOAD
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;

// Create a new Dompdf instance
$dompdf = new Dompdf();


// FUNCTIONS
include_once("../includes/functions.php");


if(isset($_POST['download_pdf'])){
  $page_name = $_POST['download'];
}

switch ($page_name) {
  case 'timetable':
    $table = time_table(0);
    break;
    case 'staffs':
    $table = staff_table(0);
    break;
  case 'department':
    $table = dept_table(0);
    break;
  case 'courses':
    $table = course_table(0);
    break;
  case 'classroom':
    $table = classroom_table(0);
    break;
  default:
    $table = "<h2>PDF is not redy...</h2>";
    break;
}

// HEADER FOR DOWNLOAD PAGE
// include_once("../includes/header_dowload.php");

// THE NAME AND PATH FOR THE PDF
$pdf_name = "BUK_{$page_name}.pdf";

// LINK TO DOWNLOAD PDF
$download_link = " <div class='download-container'>
  <a href='{$pdf_name}' class='text-base  mx-2 no-underline 
  hover:scale-110 focus:outline-none 
  px-4 py-2 rounded font-bold cursor-pointer max-w-fit m-auto
  hover:bg-green-500 text-center bg-green-400 text-gray-100
  border duration-200 ease-in-out border-green-400 
  transition' target='_blank' rel='noopener noreferrer' download>
  Click To Start Download</a>
</div>";


// HTML FOR THE PDF LAYOUT
$html = "";
$html .= "<!DOCTYPE html>
<html>
  <head>
    <meta charset='UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <link
      href=''
      rel='stylesheet'
    />
    <title></title>
    <!-- TAILWIND CSS -->
    <script src='https://cdn.tailwindcss.com'></script>
  </head>
  <body>

<style>

.table-container{
    padding:20px;
    margin: 0 auto;
    width: 90%;
    position:relative;
}
table {
    margin: 0 auto;
    margin-top: 10px;
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}
.text-center{
  text-align: center;
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
h1, h2{
  padding: 8 auto 0;
  margin: 0 auto;
  width: 90%;
  text-align:center;
}
.middle{
  text-align: center;
}
</style>

<div class='py-4 px-3 my-8 mx-10 border border-gray-400' >";
$html .= "<h1>BAYERO UNIVERSITY, KANO</h1><h2>FACULTY OF CUMPUTING</h2>";
$html .= $table;
$html .=  "</div></body></html>";




// echo $html;
// Dounload Link Button
// echo $download_link;

// Load the HTML to PDF
$dompdf->loadHtml($html);

// Set the PDF
$dompdf ->setPaper('A4', 'landscape');
$dompdf->render();

// Get the generated PDF output
$output = $dompdf->output(); 

// Save the PDF to a file
if(file_exists($page_name)){
  unlink("{$pdf_name}");
}


file_put_contents("{$pdf_name}", $output); 



// Or output the PDF directly to the browser
// Make sure you remove any output or echo statement before streaming the pdf
$dompdf->stream("{$pdf_name}");


// include("../includes/footer_download.php");

?>