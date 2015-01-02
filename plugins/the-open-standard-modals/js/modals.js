function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}

function ModalsClass() {
	this.openModal = null;
	this.ignoreNextStateChange = false;

	$('body').on('click', 'a[data-modal]', function() {
		var modalUrl = $(this).attr('data-modal-content');
		var modalQuery = $(this).attr('data-modal-query');

		Modals.open(modalUrl || null, modalQuery, true);
		return false;
	});

	$('body').on('click', 'a[data-modal-close]', function() {
		Modals.close();
		return false;
	});

	History.Adapter.bind(window, 'statechange', function(e) {
		if (Modals.ignoreNextStateChange) {
			Modals.ignoreNextStateChange = false;
			return;
		}

		var state = History.getState();
		var u = new URI(state.url);
		if (u.query(true).modal) {
			if (u.query(true).modal != Modals.openModal)
				Modals.open(u.query(true).modal, null, false);
		} else {
			Modals.close();
		}
	});
}

ModalsClass.prototype.open = function(modalContent, modalQuery, updateUrl) {
	if (!modalContent)
		return;

	this.openModal = modalContent + (modalQuery || '');

	var modal = $('#modal');
	modal.html('');

	$.get('/modal?m=' + modalContent + (modalQuery || ''), function(response) {
		modal.html(response);
	});

	modal.addClass('open');
	$('body').addClass('modal-open');

	if (updateUrl) {
		var u = new URI();
		u.setSearch('modal', modalContent);
		History.pushState({}, document.title, u.toString() + (modalQuery || ''));
	}
}

ModalsClass.prototype.close = function(modalContent) {
	if (!this.openModal)
		return

	if (!modalContent)
		modalContent = this.openModal;

	this.openModal = null;

	var modal = $('#modal');
	modal.removeClass('open');

	var u = new URI();
	u.removeSearch('modal');
	History.pushState({}, '', u.toString());

	$('body').removeClass('modal-open');
}

$(function() {
	window.Modals = new ModalsClass();
	var u = new URI();
	if (u.query(true).modal) {
		var queryString = u.query(true);
		var modalContent = queryString.modal;
		delete queryString.modal;
		Modals.open(modalContent);
	}
})