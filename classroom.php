<?php
// PAGE HEADER
include_once("includes/header_new.php");
?>


<!-- START OF PAGE -->
<div class="page">
    <!-- <h1 class="text-center py-6">WELCOM HOME</h1> -->

<!-- START OF TABLE CONTAINER -->
<div class="grid mb-4 pb-10 px-8 mx-4 rounded-3xl bg-gray-100 border-4 border[#08a7fd] w-[100%] mx-auto">
<?php

    echo classroom_table(0);

    // Download PDF
    download_content_pdf();

?>
</div>
<!-- END OF TABLE CONTAINER -->


</div>
<!-- END OF PAGE -->


<?php
// PAGE FOOTER
include_once("includes/footer.php");
?>