<section>
<script>
// JavaScript code for slider functionality
var slider = document.querySelector('.slider');
var slides = Array.from(document.querySelectorAll('.slide'));

var slideWidth = slides[0].offsetWidth;
var slideIndex = 0;

// Set initial position of slider
slider.style.transform = 'translateX(' + (-slideWidth * slideIndex) + 'px)';

function nextSlide() {
  slideIndex++;
  if (slideIndex >= slides.length) {
    slideIndex = 0;
  }
  slider.style.transform = 'translateX(' + (-slideWidth * slideIndex) + 'px)';
}

function previousSlide() {
  slideIndex--;
  if (slideIndex < 0) {
    slideIndex = slides.length - 1;
  }
  slider.style.transform = 'translateX(' + (-slideWidth * slideIndex) + 'px)';
}

// Auto slide every 3 seconds
setInterval(nextSlide, 3000);


</script>
</section>



<!-- FOOTER START -->
<footer class="mt-10 p-4 pt-6 m-auto w-full buttom-0">
    
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-center md:justify-between justify-center">
            <div class="w-full md:w-6/12 px-4 mx-auto text-center">
            <div class="text-sm text-slate-500 font-semibold py-1">
                <?php echo $page_title_footer; ?> &copy; <?php echo date("Y") ?>
                <a href="https://bit.ly/amtech_digital_networks" 
                class="text-slate-700 hover:text-slate-500" target="_blank">
                ( Dev. AMTECH )</a>
            </div>
            </div>
        </div>
    </div>
</footer>



<!-- START OF PAGE is inside header -->
</div>
<!-- END OF PAGE -->




</body>
</html>
<!-- FOOTER END -->

</body>
</html>