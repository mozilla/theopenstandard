<?php get_header(); ?>

<?php 
	$searched_category = $featured_term_id = get_category_by_slug($_GET['cat']);
	if ($_GET['cat'])
		$default_search_params['cat'] = htmlspecialchars($_GET['cat']);
?>

<div class="header">
	<div class="row">
		<div class="medium-8 medium-centered columns text-center">
			<?php
			if ($searched_category && !$_GET['s']) { 
				$category_all = true;
			} else if ($searched_category) {
				$category_searched = true;
			} 
			?>

			<h1 class="search-header category-all" <?php if ($category_all): ?> style="display: block;"<?php endif; ?>><?php echo $searched_category->name; ?> - All Articles</h1>
			<h1 class="search-header category-searched" <?php if ($category_searched): ?> style="display: block;"<?php endif; ?>>Search Results in <?php echo $searched_category->name; ?></h1>
			<?php if (!$category_all && !$category_searched) { ?>
				<h1>Search Results</h1>
			<?php
			} ?>

			<p class="results-message" <?php if (!$_GET['s']): ?>style="display: none;"<?php endif; ?>>Showing results for: <em class="search-query">"<?php echo htmlspecialchars($_GET['s']); ?>"</em></p>
			<?php TheOpenStandardSearch::search_form($default_search_params); ?>
		</div>
	</div>
</div>

<section class="row search-results">
</section>

<?php get_footer(); ?>