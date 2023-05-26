<?php
include_once("../includes/session.php");
include_once("../includes/functions.php");

// $_SESSION['error'] = "no error";
// $_SESSION['message'] = "no message";
// echo "<a href='../test.php'>text.php</a>";



?>



<?php
// PAGE HEADER
include_once("../includes/header_admin_new.php");

?>


<!-- START OF PAGE -->
<div class="page">
        

    <?php
        echo welcome_admin();
        echo staff_table("true");
    ?> 

        <!-- ADD CONTENT / DOWNLOAD CONTENT -->
        <div class="flex flex-row  items-center justify-center">
            <?php add_content(); ?>

            <?php download_content(); ?>
            </
        </div>
        <!-- END OF ADD CONTENT / DOWNLOAD CONTENT -->
        
</div>
<!-- END OF PAGE -->



<?php
// PAGE FOOTER
include_once("../includes/footer.php");
?>