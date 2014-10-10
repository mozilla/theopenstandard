<?php get_header(); ?>

    <?php
    	$issues = explode(' ', $_GET['issues']);

    	$issue_posts = new WP_Query(array(
	        'tag_slug__in' => $issues,
	        'posts_per_page' => 6,
	        'orderby' => 'date'
        ));		    	
    ?>

	<div class="row">
		<div class="medium-8 medium-centered columns">
			<div class="issues-detail text-center">
				<h1>In Context</h1>
				<p>Lorem ipsum dolar sit amet</p>
				<div class="socialmedia-issues">
					<?php TheOpenStandardSocial::share_links(); ?>
				</div>
				<br>
			</div>
	        <ul>
		        <?php 
		        while ($issue_posts->have_posts()): 
		            $issue_posts->the_post(); ?>
		            <li class="recent-articles-item">
		                <div class="thumbnail">
		                    <?php the_post_thumbnail('thumbnail'); ?>
		                </div>
		                <a href="<?php the_permalink(); ?>"><h3><?php echo one_of(simple_fields_fieldgroup('short_title'), get_the_title()); ?></h3></a>
		                <p><?php the_excerpt(); ?></p>
		                <p>
		                    <?php
		                    $categories = get_post_categories($post, array('featured', 'sponsored', 'lead'));
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
