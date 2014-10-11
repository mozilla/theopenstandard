<?php
	$old_post = $post;
?>

<?php
	foreach ($related_posts as $post) { ?>
		<div class="related_post">a
			<h2><?php echo one_of(simple_fields_fieldgroup('short_title'), get_the_title()); ?></h2>
			<?php the_excerpt(); ?>
			<?php 
			$categories = get_post_categories($post); 
			foreach ($categories as $category) { ?>
				<a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a>
			<?php
			} ?>
		</div>

	<?php
	} 
	
	$post = $old_post;
?>