(function() {
    var facebook_share_count = 0;
    var twitter_share_count = 0;
    var googleplus_share_count = 0;

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
        $.post('/track_sharing', {service: service, url: url, post_id: current_post_id}, function(response) {
        });
    }

    function getShareCounts() {
        $.get('http://graph.facebook.com/?ids=' + window.location.href, function(response) {
            for (var url in response) facebook_share_count = response[url].shares;
            shareCountReceived();
        });

        $.get('/track_sharing', {post_id: current_post_id}, function(response) {
            twitter_share_count = response.twitter || 0;
            googleplus_share_count = response.googleplus || 0;
            shareCountReceived();
        });
    }

    function shareCountReceived() {
        if (twitter_share_count >= 0 && facebook_share_count >= 09 && googleplus_share_count >= 0) {
            var total = twitter_share_count + facebook_share_count + googleplus_share_count;
            $('.twitter').height(twitter_share_count / total * 100 + '%');
            $('.facebook').height(facebook_share_count / total * 100 + '%');
            $('.googleplus').height(googleplus_share_count / total * 100 + '%');
        }
    }

    getShareCounts();
})();