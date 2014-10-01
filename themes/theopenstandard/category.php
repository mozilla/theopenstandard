<?php get_header(); ?>

    <?php
    	$category = get_queried_object();
    	$featured_term_id = get_category_by_slug('featured')->term_id;

    	$featured_posts = new WP_Query(array(
	        'category__and' => array($category->term_id, $featured_term_id),
	        'posts_per_page' => 3,
	        'orderby' => 'date'
        ));

        $category_posts = new WP_Query(array(
            'cat' => $category->term_id,
            'category__not_in' => $featured_term_id,
            'posts_per_page' => 6,
            'orderby' => 'date'
        ));
    ?>

	<div class="row">
		<div class="columns small-4">
	        <?php 
	        while ($featured_posts->have_posts()): 
	            $featured_posts->the_post(); ?>
	        	<article class="featured">
	                <?php the_post_thumbnail('thumbnail'); ?>
	                <h2><a href="<?php get_permalink(); ?>"><?php the_title(); ?></a></h2>
	                <?php the_excerpt('Read more...'); ?>
	        	</article>
	        <?php 
	        endwhile; ?>
		</div>
		<div class="columns small-4">
	        <?php 
	        while ($category_posts->have_posts()): 
	            $category_posts->the_post(); ?>
	        	<article class="list">
	                <?php the_post_thumbnail('thumbnail'); ?>
	                <h2><a href="<?php get_permalink(); ?>"><?php the_title(); ?></a></h2>
	                <?php the_excerpt('Read more...'); ?>
	        	</article>
	        <?php 
	        endwhile; ?>
		</div>
		<div class="columns small-4">
			
		</div>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
