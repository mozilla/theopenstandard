<?php get_header(); ?>

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

<?php get_footer(); ?>
