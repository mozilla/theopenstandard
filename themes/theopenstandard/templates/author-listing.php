<?php
	function field($field_name) {
		global $author_id;
		return get_the_author_meta($field_name, $author_id);
	}
?>

<a href="<?= get_author_posts_url($author_id); ?>">
	<h2><?= field('user_nicename'); ?></h2>
	<div><?= field('description'); ?></div>
</a>