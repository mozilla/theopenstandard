<?php
	global $post;
?>

<!-- LARGER ISSUES -->
<div class="larger-issues">
	<ul class="medium-block-grid-3">
		<?php
		foreach ($related_posts as $related_post) { 
			$post = $related_post;
			setup_postdata($post);
	        $category = get_primary_category($post); ?>
	        <li class="featured-articles-item">  
	            <div class="topics-tag-normal <?php echo $category->slug; ?>">
	                <a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a>
	            </div>
	            <a href="<?php the_permalink(); ?>">
	                <img src="<?php echo get_post_thumbnail_url('homepage-featured'); ?>" />
	            	<h3><?php echo one_of(simple_fields_fieldgroup('short_title'), get_the_title()); ?></h3>
	            </a>
				
	        </li>
		<?php
		} 

		wp_reset_postdata();	
	?>
	</ul>
</div>

<?php
if ($related_posts) { ?>
    <hr class="tall">
<?php 
} ?>
