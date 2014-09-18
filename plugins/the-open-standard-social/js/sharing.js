(function() {
    var facebookShareCount = 0;
    var twitterShareCount = 0;
    var googleplusShareCount = 0;

    // Callback for sharing with twitter.
    twttr.ready(function() {
        twttr.events.bind('tweet',
            function (event) {
                trackShare('twitter', window.location.href);
            }
        );
    });

    // Callback for sharing with google+
    window.googlePlusShare = function(response) {
        trackShare('googleplus', response.href);
    }

    // Tell the database about the share.
    function trackShare(service, url) {
        $.post('/track_sharing', {service: service, url: url, post_id: currentPostId}, function(response) {
        });
    }

    function getShareCounts() {
        $.get('http://graph.facebook.com/?ids=' + window.location.href, function(response) {
            for (var url in response) facebookShareCount = response[url].shares;
            shareCountReceived();
        });

        $.get('/track_sharing', {post_id: currentPostId}, function(response) {
            twitterShareCount = response.twitter || 0;
            googleplusShareCount = response.googleplus || 0;
            shareCountReceived();
        });
    }

    function shareCountReceived() {
        if (twitterShareCount >= 0 && facebookShareCount >= 0 && googleplusShareCount >= 0) {
            var total = twitterShareCount + facebookShareCount + googleplusShareCount;
            $('.twitter').height(twitterShareCount / total * 100 + '%');
            $('.facebook').height(facebookShareCount / total * 100 + '%');
            $('.googleplus').height(googleplusShareCount / total * 100 + '%');
        }
    }

    getShareCounts();
})();