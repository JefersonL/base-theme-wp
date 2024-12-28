(function($) {
    'use strict';
    
    // Document ready
    $(document).ready(function() {
        // Mobile menu toggle
        $('.menu-toggle').on('click', function(e) {
            e.preventDefault();
            $('.primary-menu').toggleClass('menu-open');
        });

        // Smooth scroll for anchor links
        $('a[href*="#"]').not('[href="#"]').click(function(e) {
            if (
                location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') &&
                location.hostname === this.hostname
            ) {
                e.preventDefault();
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                    return false;
                }
            }
        });
    });
})(jQuery);
