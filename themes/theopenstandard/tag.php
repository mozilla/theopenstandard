<?php get_header(); ?>

    <?php
    	$tag = get_queried_object();
    	$tagged_posts = new WP_Query(array(
	        'tag' => $tag->slug,
	        'posts_per_page' => 6,
	        'orderby' => 'date'
        ));
    ?>

	<div class="row">
		<div class="columns small-12">
	        <?php 
	        while ($tagged_posts->have_posts()): 
	            $tagged_posts->the_post(); ?>
	        	<article class="featured">
	                <?php the_post_thumbnail('thumbnail'); ?>
	                <h2><a href="<?php get_permalink(); ?>"><?php the_title(); ?></a></h2>
	                <?php the_excerpt('Read more...'); ?>
	        	</article>
	        <?php 
	        endwhile; ?>
		</div>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
