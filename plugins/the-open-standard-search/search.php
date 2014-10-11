<div class="columns small-12">
    <?php if ($searched_posts->have_posts()) : ?>
        <h2><?php _e('Search Results','html5reset'); ?></h2>
        <ul class="results-list">
        <?php while ($searched_posts->have_posts()):
            $searched_posts->the_post(); ?>
            <?php include 'search-item.php'; ?>
        <?php endwhile; ?>
        </ul>

        <?php if ($show_more_link) { ?>
            <a data-show-more href="#">More &gt;</a>
        <?php } ?>

    <?php else : ?>
        <h2><?php _e('Nothing Found','html5reset'); ?></h2>
    <?php endif; ?>
</div>

