<div class="author-bio small-12 medium-3 columns">
	<img src="<?php echo get_wp_user_avatar_src(get_the_author_meta('ID'), 150); ?>" class="author-bio-image">
    
    <p><?php echo get_the_author(); ?></p>
	<ul class="social-icon-links inline-list">
		<?php if (get_the_author_meta('twitter')): ?>
			<li><a href="<?php the_author_meta('twitter'); ?>"><img src="<?php theme_image_src('icons/social-twitter.svg'); ?>"></a></li>
		<?php endif; ?>
		<?php if (get_the_author_meta('facebook')): ?>
			<li><a href="<?php the_author_meta('facebook'); ?>"><img src="<?php theme_image_src('icons/social-facebook.svg'); ?>"></a></li>
		<?php endif; ?>
		<?php if (get_the_author_meta('googleplus')): ?>
			<li><a href="<?php the_author_meta('googleplus'); ?>"><img src="<?php theme_image_src('icons/social-google-plus.svg'); ?>"></a></li>
		<?php endif; ?>
	</ul>
	<ul class="tag-list">
		<?php
    	$author_posts = new WP_Query(array(
    		'author' => $author_id,
            'posts_per_page' => -1
    	));

    	$tags = array();

        while ($author_posts->have_posts()): 
            $author_posts->the_post(); 
        	$post_tags = get_the_tags();
        	foreach ($post_tags as $post_tag) {
        		$tags[$post_tag->slug] = $post_tag;
        	}
        endwhile;

        foreach ($tags as $tag) { ?>
			<li class="issues-tag"><a href="<?php TheOpenStandardIssues::the_issues_link(); ?>" class="issues-<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
        <?php 
        } ?>
	</ul>
</div>