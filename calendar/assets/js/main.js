(function($) {
	'use strict';

	$(document).ready(function($) {
		// Preloader
		setTimeout(function () {
			$('.preloader').fadeOut();
		}, 2000);
		
		// Back-to-top button
		$(window).on('scroll', function () {
            if ($(this).scrollTop() > 400) {
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }

            return false;
        });
		$('.back-to-top').on('click', function(e) {
			e.preventDefault();
			$('html, body').animate({
				scrollTop: 0
			}, 700);
		});

		// Menu
		$('.nav-item a').on('click', function(e) {
			e.preventDefault();
			$('html, body').animate({
				scrollTop: $($(this).attr('href')).offset().top - 100 + "px"
			}, 700);
		});
	});
})(jQuery);
