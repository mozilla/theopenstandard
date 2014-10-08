function ModalsClass() {}

ModalsClass.prototype.open = function(modalSlug) {
	if (!modalSlug)
		return;

	var modal = $('#' + modalSlug + '-modal');

	modal.attr('src', modal.attr('_src'));
	modal.addClass('open');
}

var Modals = new ModalsClass();