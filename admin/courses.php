<?php
include_once("../includes/session.php");
include_once("../includes/functions.php");
?>

<?php
// PAGE HEADER
include_once("../includes/header_admin_new.php");


$msg = "";

// ADD STAFF MESSAGE
if(isset($_GET['message'])){
    $msg .= "<script>
                alert(\"Admin : ({$_GET['message']}) Sucessfully Added.\");
                setTimeout(() => window.location = \"courses.php\", 30);
        </script>";
        $_GET['message'] ="";
    echo $msg;
}
// EDIT STAFF
if(isset($_GET['edit'])){
    $msg .= "<script>
                alert(\"Admin : ({$_GET['edit']}) Sucessfully Updated.\");
                setTimeout(() => window.location = \"courses.php\", 30);
        </script>";
        $_GET['edit'] ="";
    echo $msg;
}
// DELETE STAFF
if(isset($_GET['deleted'])){
    $msg .= "<script>
                alert(\"Admin : ({$_GET['deleted']}) Sucessfully Deleted.\");
                setTimeout(() => window.location = \"courses.php\", 30);
        </script>";
        $_GET['deleted'] ="";
    echo $msg;
}

?>


<!-- START OF PAGE -->
<div class="page">
    <?php
        echo welcome_admin();
        echo course_table("true");
    ?>

    <!-- ADD CONTENT / DOWNLOAD CONTENT -->
    <div class="flex items-center justify-center h-10 intro-y">
        <?php add_content(); ?>
        <?php download_content(); ?>
    </div>
    <!-- END OF ADD CONTENT / DOWNLOAD CONTENT -->

</div>
<!-- END OF PAGE -->


<?php
// PAGE FOOTER
include_once("../includes/footer.php");
?>