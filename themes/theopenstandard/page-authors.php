<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
 get_header(); ?>

<h2>List of authors:</h2>
<?php 
$authors = get_users(array(
	'role' => 'author',
	'fields' => 'ID'
));

foreach ($authors as $author_id) {
	include('templates/author-listing.php');
}

?> 

<?php get_sidebar(); ?>

<?php get_footer(); ?>
