<script>var current_post_id = <?= the_ID(); ?></script>

<div class="sharing">
	<ul class="share-ratios">
		<li class="twitter"><div class="bar"></div></li>
		<li class="facebook"><div class="bar"></div></li>
		<li class="googleplus"><div class="bar"></div></li>
	</ul>
	<ul class="share-buttons">
		<li>
			<button class="twitter-button-override"></button>
			<a class="twitter-share-button" data-count="none" href="https://twitter.com/share">Tweet</a>
		</li>
		<li>
			<button class="facebook-button-override"></button>
			<div class="fb-like" data-href="<?= "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
		</li>
		<li>
			<button class="googleplus-button-override"></button>
			<div class="g-plusone" data-count="none" data-size="standard (bubble)" data-callback="googlePlusShare"></div>
		</li>
	</ul>
</div>

<!-- Twitter -->
<script type="text/javascript">
	window.twttr=(function(d,s,id){var t,js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return}js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);return window.twttr||(t={_e:[],ready:function(f){t._e.push(f)}})}(document,"script","twitter-wjs"));
</script>

<!-- Facebook -->
<div id="fb-root"></div>
<script type="text/javascript">
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=485995838134015&version=v2.0";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

<!-- Google+ -->
<script type="text/javascript">
	(function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js?onload=googlePlusLoaded';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	})();
</script>