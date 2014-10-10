(function() {
    $(window).load(function() {
        function attachSearchListeners() {
            var url = new URI();

            var search_form = $('[data-search]');
            search_form.submit(function() {
                var search_input = $(this).find('input[type=search]');

                var params = {
                    s: search_input.val(),
                }

                var hidden = $(this).find('input[type="hidden"]');
                if (hidden.length) {
                    hidden.each(function() {
                        params[$(this).attr('name')] = $(this).attr('value');
                    });
                }

                if (!params.s && !hidden.length) {
                    return false;
                }

                var u = new URI();
                u.setSearch('s', search_input.val());
                History.pushState({}, '', u.toString());

                $.get('/search-request?' + $.param(params), function(response) {
                    $('section.search-results').html(response);
                });
                return false;
            });

            if (url.query(true).s) {
                search_form.trigger('submit');
            }
        }

        attachSearchListeners();
    });
})();