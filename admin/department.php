<?php
include_once("../includes/session.php");
include_once("../includes/functions.php");
?>

<?php
// PAGE HEADER
include_once("../includes/header_admin_new.php");

?>


<!-- START OF PAGE -->
<div class="page">

    <?php
        echo welcome_admin();
        echo dept_table("true");
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