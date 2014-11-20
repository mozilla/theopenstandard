window.Gallery = function(fullSelector, thumbsSelector, startImage) {
	var fullContainer = $(fullSelector);
	var thumbsContainer = $(thumbsSelector);
	var displayImages = fullContainer.find('div.full_image');
	var currentImage = startImage;

	var viewImage = function(i) {
		currentImage = i;

		if (currentImage > displayImages.length-1)
			currentImage = 0;

		if (currentImage < 0)
			currentImage = displayImages.length-1

		displayImages.removeClass('active');
		var img = displayImages.eq(currentImage);

		if (!img.hasClass('loaded') && !img.hasClass('initialized'))
			loadImage(img, true);

		img.addClass('active');
	}

	var loadImage = function(img, force) {
		var next = img.next('.full_image');
		var proxyImage = $('<img/>');

		if (!img.hasClass('initialized')) {
			img.addClass('initialized');
			var timeout;

			var doneLoading = function() {
				clearTimeout(timeout);

				// Load the next image in line, unless called with force. Don't want multiple load threads.
				if (next.length && !force)
					loadImage(next);
				proxyImage.unbind('load', doneLoading);
				img.css('background-image', 'url(' + proxyImage.attr('src') + ')');
				img.addClass('loaded');
				proxyImage.remove()
			};

			// The load event is more reliable on an image element, so we'll make a proxy element to load the background image.
			proxyImage.load(doneLoading);

			proxyImage.attr('src', img.attr('_src'));

			// Set a timeout so if the load event fails us, we load the image eventually.
			timeout = setTimeout(function() {
				doneLoading();
			}, 800);
		} else {
			if (next.length)
				loadImage(next);
		}
	}

	thumbsContainer.on('click', 'div.thumbnail', function() {
		viewImage($(this).index());
	});

	fullContainer.on('click', 'div.arrow-right', function() {
		viewImage(currentImage+1);
		return false;
	}).on('click', 'div.arrow-left', function() {
		viewImage(currentImage-1);
		return false;
	});

	viewImage(currentImage);
	loadImage(displayImages.eq(0));
};