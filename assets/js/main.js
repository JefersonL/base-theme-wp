(function($) {
    'use strict';
    
    $(document).ready(function() {
        // Menu Toggle
        $('.menu-toggle').on('click', function() {
            $(this).toggleClass('active');
            $('.primary-navigation').toggleClass('active');
        });

        // Search Toggle
        $('.search-toggle').on('click', function(e) {
            e.preventDefault();
            $('.search-form-container').toggleClass('active');
        });

        // Fechar busca ao clicar fora
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.header-search').length) {
                $('.search-form-container').removeClass('active');
            }
        });

        // Ajuste do padding-top do body para o menu fixo
        function adjustBodyPadding() {
            var headerHeight = $('.site-header').outerHeight();
            $('body').css('padding-top', headerHeight + 'px');
        }

        // Executar no carregamento e no redimensionamento
        adjustBodyPadding();
        $(window).on('resize', adjustBodyPadding);

        // Smooth scroll para links âncora
        $('a[href*="#"]').not('[href="#"]').click(function(e) {
            if (
                location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') &&
                location.hostname === this.hostname
            ) {
                e.preventDefault();
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    var headerHeight = $('.site-header').outerHeight();
                    $('html, body').animate({
                        scrollTop: target.offset().top - headerHeight
                    }, 1000);
                    return false;
                }
            }
        });
    });
})(jQuery);
