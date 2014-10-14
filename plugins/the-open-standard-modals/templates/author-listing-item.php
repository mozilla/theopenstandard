<div class="author-bio small-12 medium-3 columns">
	<?php $authordata = get_user_by('id', $author_id); ?>
	<a href="#" data-modal data-modal-content="author" data-modal-query="/<?php the_author_meta('user_nicename', $author_id); ?>">
		<img src="<?php echo get_wp_user_avatar_src(get_the_author_meta('ID', $author_id), 150); ?>" class="author-bio-image">
	    <p><?php the_author_meta('display_name',  $author_id); ?></p>
	</a>
	<ul class="social-icon-links inline-list">
		<?php if (get_the_author_meta('twitter', $author_id)): ?>
			<li><a href="<?php the_author_meta('twitter', $author_id); ?>"><img src="<?php theme_image_src('icons/social-twitter-grey.svg'); ?>"></a></li>
		<?php endif; ?>
		<?php if (get_the_author_meta('facebook', $author_id)): ?>
			<li><a href="<?php the_author_meta('facebook', $author_id); ?>"><img src="<?php theme_image_src('icons/social-facebook-grey.svg'); ?>"></a></li>
		<?php endif; ?>
		<?php if (get_the_author_meta('googleplus', $author_id)): ?>
			<li><a href="<?php the_author_meta('googleplus', $author_id); ?>"><img src="<?php theme_image_src('icons/social-google-plus-grey.svg'); ?>"></a></li>
		<?php endif; ?>
	</ul>

	<?php
	$author_posts = new WP_Query(array(
		'author' => $author_id,
        'posts_per_page' => -1
	));

	$categories = array();

    while ($author_posts->have_posts()): 
        $author_posts->the_post(); 
    	$post_categories = get_post_categories($post);
    	foreach ($post_categories as $post_category) {
    		$categories[$post_category->slug] = $post_category;
    	}
    endwhile;

    foreach ($categories as $category) { ?>
    	<a href="/search?cat=<?php echo $category->slug; ?>&author=<?php the_author_meta('user_nicename', $author_id); ?>" class="topics-tag-minimal <?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
    <?php
    } ?>
</div>