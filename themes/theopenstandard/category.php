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

	<div class="header">
		<div class="row">
			<div class="medium-8 medium-centered columns text-center">
				<h1><?php echo $category->name; ?></h1>
				<p><?php echo $category->description; ?></p>
				<?php TheOpenStandardSearch::search_form(array('cat' => $category->slug), false); ?>
			</div>
		</div>
	</div>

	<section class="row search-results">
	</section>

	<section class="body topics-page">
		<div class="row">
			<!-- FEATURED ARTICLES -->
			<div class="large-5 columns">
				<ul class="featured-articles">
			        <?php 
			        while ($featured_posts->have_posts()): 
			            $featured_posts->the_post(); ?>
						<li class="featured-articles-item <?php echo $category->slug; ?> <?php echo has_category('sponsored') ? 'sponsored-content-container' : ''; ?>">
			                <?php the_post_thumbnail('large'); ?>
							<a href="<?php the_permalink(); ?>"><h3><?php echo one_of(simple_fields_fieldgroup('short_title'), get_the_title()); ?></h3></a>
							<p><?php the_excerpt(); ?></p>
							<p><span class="timestamp"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span></p>
              				<?php
                            if (has_category('sponsored')) { ?>
                                <p class="sponsored-content">Sponsored</p>
                            <?php
                            } ?>
						</li>
			        <?php 
			        endwhile; ?>
				</ul>
			</div>
			<!-- RECENT ARTICLES -->
			<div class="large-4 columns">
				<ul class="recent-articles">
			        <?php 
			        while ($category_posts->have_posts()): 
			            $category_posts->the_post(); ?>
						<li class="recent-articles-item <?php echo $category->slug; ?> <?php echo has_category('sponsored') ? 'sponsored-content-container' : ''; ?>">
			                <?php the_post_thumbnail(array(80,80), array('class' => 'thumbnail')); ?>
              				<?php
                            if (has_category('sponsored')) { ?>
                                <p class="sponsored-content">Sponsored</p>
                            <?php
                            } ?>
							<a href="<?php the_permalink(); ?>"><h3><?php echo one_of(simple_fields_fieldgroup('short_title'), get_the_title()); ?></h3></a>
							<p><?php the_excerpt(); ?></p>
							<p><span class="timestamp"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span></p>
						</li>
			        <?php 
			        endwhile; ?>
				</ul>
			</div>
			<!-- FROM AROUND THE WEB -->
			<div class="large-3 columns">
                <?php the_around_the_web_menu('Around The Web (' . $category->name . ')'); ?>
			</div>

		</div>
		<div class="row">
			<div class="medium-8 medium-centered columns text-center">
				<a href="/search?cat=<?php echo $category->slug; ?>">All Articles &gt;</a>
			</div>
		</div>		
	</section>

<?php get_footer(); ?>
