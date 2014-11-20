window.Gallery = function(full_selector, thumbs_selector) {
	var full_container = $(full_selector);
	var thumbs_container = $(thumbs_selector);
	var displayImages = full_container.find('div.full_image');

	var viewImage = function(i) {

	}

	var loadImage = function(img) {
		var next = img.next();
		var proxy_image = $('<img/>');

		if (!img.hasClass('initialized')) {
			doneLoading = function() {
				if (next)
					loadImage(next);
				proxy_image.unbind('load', doneLoading);
				img.css('background-image', 'url(' + proxy_image.attr('src') + ')');
				proxy_image.remove()
			};

			// The load event is more reliable on an image element, so we'll make a proxy element to load the background image.
			proxy_image.load(doneLoading);
			
			proxy_image.attr('src', img.attr('_src'));

			// Set a timeout so if the load event fails us, we load the image eventually.
			setTimeout(function() {
				doneLoading();
			}, 1000);
		}
	}

	thumbs_container.on('click', 'div.thumbnail', function() {
		viewImage($(this).index());
	});

	loadImage(displayImages.eq(0));
	viewImage(0);
};