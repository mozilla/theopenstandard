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
	        <ul>
		        <?php 
		        while ($tagged_posts->have_posts()): 
		            $tagged_posts->the_post(); ?>
		            <li class="recent-articles-item">
		                <div class="thumbnail">
		                    <?php the_post_thumbnail('thumbnail'); ?>
		                </div>
		                <a href="<?php the_permalink(); ?>"><h3><?php echo one_of(simple_fields_fieldgroup('short_title'), get_the_title()); ?></h3></a>
		                <p><?php the_excerpt(); ?></p>
		                <p>
		                    <?php
		                    $categories = get_post_categories($post);
		                    foreach ($categories as $category) { ?>
		                        <a href="<?php echo get_category_link($category->term_id); ?>" class="topics-tag-minimal <?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
		                    <?php
		                    } ?>
		                    <span class="timestamp"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
		                </p>
		            </li>
		        <?php 
		        endwhile; ?>
		    </ul>
		</div>
	</div>

<?php get_footer(); ?>
