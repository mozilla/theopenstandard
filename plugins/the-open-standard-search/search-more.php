<?php while ($searched_posts->have_posts()):
    $searched_posts->the_post(); ?>
    <?php include 'search-item.php'; ?>
<?php endwhile; ?>