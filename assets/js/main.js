(function ($) {
    "use strict";
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#back-to-top').addClass('opacity-100').removeClass('opacity-0');
        } else {
            $('#back-to-top').addClass('opacity-0').removeClass('opacity-100');
        }
    });
    
    $('#back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });

    // Testimonials carousel (if still used)
    if ($(".testimonial-carousel").length > 0) {
        $(".testimonial-carousel").owlCarousel({
            autoplay: true,
            smartSpeed: 1500,
            margin: 30,
            dots: true,
            loop: true,
            center: true,
            responsive: {
                0:{ items:1 },
                576:{ items:1 },
                768:{ items:2 },
                992:{ items:3 }
            }
        });
    }
    
})(jQuery);
