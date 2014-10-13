<?php get_header(); ?>

    <?php
    	$issues = explode(' ', $_GET['issues']);

    	$issue = get_term_by('slug', $issues[0], 'post_tag');

    	$issue_posts = new WP_Query(array(
	        'tag_slug__in' => $issues,
	        'posts_per_page' => 10,
	        'orderby' => 'date'
        ));		    	
    ?>

	<div class="row">
		<div class="medium-8 medium-centered columns">
			<div class="issues-detail text-center">
				<h1>In Context</h1>
				<p><?php echo $issue->description; ?></p>
				<div class="socialmedia-issues">
					<?php TheOpenStandardSocial::share_links(); ?>
				</div>
				<br>
			</div>
	        <ul>
		        <?php 
		        while ($issue_posts->have_posts()): 
		            $issue_posts->the_post(); 
		        	$category = get_primary_category($post); ?>

		            <li class="recent-articles-item <?php echo $category->slug; ?> <?php echo has_category('sponsored') ? 'sponsored-content-container' : ''; ?>">
                        <?php
                        if (has_category('sponsored')) { ?>
                            <p class="sponsored-content">Sponsored</p>
                        <?php
                        } ?>
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
