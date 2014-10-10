<?php get_header(); ?>

<div class="header">
	<div class="row">
		<div class="medium-8 medium-centered columns text-center">
			<h1>Search Results</h1>
			<p>Showing results for: <em>"<?php echo htmlspecialchars($_GET['s']); ?>"</em></p>
			<?php TheOpenStandardSearch::search_form(); ?>
		</div>
	</div>
</div>

<section class="row search-results">
</section>

<?php get_footer(); ?>