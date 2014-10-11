(function() {
    $(window).load(function() {
        function attachSearchListeners() {
            var url = new URI();
            var query = url.query(true);
            var params = {};
            params.page = query.page || 1;

            var search_form = $('[data-search]');
            search_form.submit(function() {
                var search_input = $(this).find('input[type=search]');

                params.page = 1;
                params.s = search_input.val(),

                $('em.search-query').text(search_input.val());

                var hidden = $(this).find('input[type="hidden"]');
                if (hidden.length) {
                    hidden.each(function() {
                        params[$(this).attr('name')] = $(this).attr('value');
                    });
                }

                if (!params.s && !hidden.length) {
                    return false;
                }

                if (!params.s) {
                    $('.results-message').hide();
                } else {
                    $('.results-message').show();
                }

                $('h1.search-header').hide();
                if (params.cat && params.s) {
                    $('h1.category-searched').show();
                } else if (params.cat) {
                    $('h1.category-all').show();
                }

                if (params.s) {
                    var u = new URI();
                    u.setSearch('s', search_input.val());
                    History.pushState({}, '', u.toString());
                }

                $.get('/search-request?' + $.param(params), function(response) {
                    $('section.search-results').html(response);
                });
                return false
            });

            $('section.search-results').on('click', 'a[data-show-more]', function() {
                params.page += 1;
                $.get('/search-request?' + $.param(params), function(response) {
                    $('section.search-results ul.results-list').append(response);
                });
                return false;
            });

            if (query.s || query.cat) {
                search_form.trigger('submit');
            }
        }

        attachSearchListeners();
    });
})();