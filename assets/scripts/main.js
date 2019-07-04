/* ========================================================================
* DOM-based Routing
* Based on http://goo.gl/EUTi53 by Paul Irish
*
* Only fires on body classes that match. If a body class contains a dash,
* replace the dash with an underscore when adding it to the object below.
*
* .noConflict()
* The routing is enclosed within an anonymous function so that you can
* always reference jQuery with $, even when in .noConflict() mode.
* ======================================================================== */

(function($) {

	var $root = $('html, body');

	/* animate scrolling */
	var smoothScroll = function() {

		if(window.location.hash) {
			/* get hash from url */
			var hash = window.location.hash.substring(1);
			/* find position of element with ID retreived from hash */
			var position = $('#'+hash).offset();
			$('html, body').animate({
				scrollTop: position.top - 150
			}, 800);
		}

		/* smooth scroll all links with hash in anchor */
		$('a[href^=#]:not([data-toggle="tab"]):not(.dropdown-item)').on('click', function() {
			event.preventDefault();
			if ($(this).hasClass("nav-link")) {
				if (viewport.is("<=" + $("nav.navbar").attr("toggle-on"))) {
					$(".navbar-toggler").trigger("click");
				}
			}

			$root.animate({
				scrollTop: $(this.hash).offset().top - 150
			}, 800);

			return false;
		});

		/* smooth scroll all buttons with scrollto atrribute */
		$("button[data-scrollto]").on("click", function(){
			$root.animate({
				scrollTop: $($(this).data("scrollto")).offset().top - 150
			}, 800);
		});

	};

	var lazyLoadRevealImg = function() {

		$(document).on('open.zf.reveal', function() {

			$(this).find('img[data-src]').each(function() {

				lazySizes.loader.unveil( $(this)[0] );
			});


		});
	};

	/* Use this variable to set up the common and page specific functions. If you */
	/* rename this variable, you will also need to rename the namespace below. */
	var Sage = {
		/* All pages */
		'common': {
			init: function() {
				/* JavaScript to be fired on all pages */

				/* Initialize foundation-sites javascript */
				$(document).foundation();

			},
			finalize: function() {
				/* JavaScript to be fired on all pages, after page specific JS is fired				 */

				if ( typeof smoothScroll === "function" ) {

					smoothScroll();
				}

			}
		},
		/* Home page */
		'home': {
			init: function() {
				/* JavaScript to be fired on the home page */

			},
			finalize: function() {
				/* JavaScript to be fired on the home page, after the init JS */

			}
		},
		'post_type_archive_team_member': {
			init: function() {
				/* JavaScript to be fired on the home page */

			},
			finalize: function() {
				/* JavaScript to be fired on the home page, after the init JS */

				if ( typeof lazyLoadRevealImg === "function" ) {

					lazyLoadRevealImg();
				}
			}
		},
	};

	/* The routing fires all common scripts, followed by the page specific scripts. */
	/* Add additional events for more control over timing e.g. a finalize event */
	var UTIL = {
		fire: function(func, funcname, args) {
			var fire;
			var namespace = Sage;
			funcname = (funcname === undefined) ? 'init' : funcname;
			fire = func !== '';
			fire = fire && namespace[func];
			fire = fire && typeof namespace[func][funcname] === 'function';

			if (fire) {
				namespace[func][funcname](args);
			}
		},
		loadEvents: function() {
			/* Fire common init JS */
			UTIL.fire('common');

			/* Fire page-specific init JS, and then finalize JS */
			$.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
				UTIL.fire(classnm);
				UTIL.fire(classnm, 'finalize');
			});

			/* Fire common finalize JS */
			UTIL.fire('common', 'finalize');
		}
	};

	/* Load Events */
	$(document).ready(UTIL.loadEvents);

})(jQuery); /* Fully reference jQuery after this point. */
