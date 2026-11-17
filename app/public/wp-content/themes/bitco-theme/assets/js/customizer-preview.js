/**
 * File customizer-preview.js.
 * Theme Customizer live preview handlers (postMessage)
 */
(function ($) {
	// Primary Color
	wp.customize('primary_color', function (value) {
		value.bind(function (newVal) {
			document.documentElement.style.setProperty('--primary', newVal);
			$('.btn-primary').css('background', newVal);
		});
	});

	// Secondary Color
	wp.customize('secondary_color', function (value) {
		value.bind(function (newVal) {
			document.documentElement.style.setProperty('--secondary', newVal);
		});
	});

	// Dark Background
	wp.customize('dark_bg_color', function (value) {
		value.bind(function (newVal) {
			document.documentElement.style.setProperty('--dark-bg', newVal);
			$('.dark-section').css('background-color', newVal);
		});
	});

	// Hero Tagline
	wp.customize('hero_tagline', function (value) {
		value.bind(function (newVal) {
			$('.hero-tagline').text(newVal);
		});
	});

	// Hero Title
	wp.customize('hero_title', function (value) {
		value.bind(function (newVal) {
			$('.hero-title').html(newVal);
		});
	});

	// Hero Description
	wp.customize('hero_description', function (value) {
		value.bind(function (newVal) {
			$('.hero-description').text(newVal);
		});
	});

	// Hero Stat 1 Label
	wp.customize('hero_stat1_label', function (value) {
		value.bind(function (newVal) {
			$('.stat-card-orange .stat-label').text(newVal);
		});
	});

	// Hero Stat 2 Label
	wp.customize('hero_stat2_label', function (value) {
		value.bind(function (newVal) {
			$('.stat-card-green .stat-label').text(newVal);
		});
	});

	// About Tag
	wp.customize('about_tag', function (value) {
		value.bind(function (newVal) {
			$('#about .section-tag').text(newVal);
		});
	});

	// About Title
	wp.customize('about_title', function (value) {
		value.bind(function (newVal) {
			$('#about .section-title').text(newVal);
		});
	});

	// About Badge Title & Desc
	wp.customize('about_badge_title', function (value) {
		value.bind(function (newVal) {
			$('.about-badge-text h4').text(newVal);
		});
	});

	wp.customize('about_badge_desc', function (value) {
		value.bind(function (newVal) {
			$('.about-badge-text p').text(newVal);
		});
	});

	// Parallax 1
	wp.customize('parallax1_title', function (value) {
		value.bind(function (newVal) {
			$('.parallax-banner:first-of-type h2').text(newVal);
		});
	});

	wp.customize('parallax1_desc', function (value) {
		value.bind(function (newVal) {
			$('.parallax-banner:first-of-type p').text(newVal);
		});
	});

	// Parallax 2
	wp.customize('parallax2_title', function (value) {
		value.bind(function (newVal) {
			$('.parallax-banner:last-of-type h2').text(newVal);
		});
	});

	wp.customize('parallax2_desc', function (value) {
		value.bind(function (newVal) {
			$('.parallax-banner:last-of-type p').text(newVal);
		});
	});

	// Footer Copyright
	wp.customize('footer_copyright', function (value) {
		value.bind(function (newVal) {
			$('.footer-bottom p').text(newVal);
		});
	});
})(jQuery);
