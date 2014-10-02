(function() {

    function attachSearchListeners() {
        var path = window.location.pathname.match('/category/(.*?)/');
        var category = path[1];
        $('#searchform').submit(function() {
            var search_input = $(this).find('input[type=search]');
            var params = {
                s: search_input.val(),
            }
            if (category)
                params.cat = category;

            $.get('/search?' + $.param(params), function(response) {
                $('section.search-results').html(response);
            });
            return false;
        });
    }

    attachSearchListeners();
})();