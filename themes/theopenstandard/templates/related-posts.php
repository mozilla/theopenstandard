<?php
	$old_post = $post;
?>

<?php
	foreach ($related_posts as $post) { ?>
		<div class="related_post">a
			<h2><?php the_title(); ?></h2>
			<?php the_excerpt(); ?>
			<?php 
			$categories = get_post_categories($post, array('featured')); 
			foreach ($categories as $category) { ?>
				<a href="<?= get_category_link($category->term_id); ?>"><?= $category->name; ?></a>
			<?php
			} ?>
		</div>

	<?php
	} 
	
	$post = $old_post;
?>