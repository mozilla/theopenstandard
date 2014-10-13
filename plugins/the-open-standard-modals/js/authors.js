$(function() {
	$('#modal').on('click', '.toggle-author', function() {
		$('.tabs a').removeClass('active');

		$(this).addClass('active');

		$('.tab.content').removeClass('active');

		$('h1.tab-section-title').text($(this).text());

		var selector = $(this).attr('href');
		$(selector).addClass('active');

		var u = new URI();
		u.setSearch('modal', $(this).text().toLowerCase());
		Modals.ignoreNextStateChange = true;
		History.replaceState({}, '', u.toString());

		return false;
	});
});