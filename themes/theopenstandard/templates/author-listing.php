<?php
	function field($field_name) {
		global $author_id;
		return get_the_author_meta($field_name, $author_id);
	}
?>

<a href="<?php echo get_author_posts_url($author_id); ?>">
	<h2><?php echo field('user_nicename'); ?></h2>
	<div><?php echo field('description'); ?></div>
</a>