<div class="columns small-12">
    <?php if (have_posts()) : ?>
        <h2><?php _e('Search Results','html5reset'); ?></h2>
        <?php post_navigation(); ?>
        <ul>
        <?php while (have_posts()) : the_post(); ?>
            <li class="recent-articles-item">
                <div class="thumbnail">
                    <?php the_post_thumbnail('thumbnail'); ?>
                </div>
                <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                <p><?php the_excerpt(); ?></p>
                <p>
                    <?php
                    $categories = get_post_categories($post, array('featured', 'sponsored'));
                    foreach ($categories as $category) { ?>
                        <a href="<?php echo get_category_link($category->term_id); ?>" class="topics-tag-minimal <?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
                    <?php
                    } ?>
                    <span class="timestamp"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                </p>
            </li>
        <?php endwhile; ?>
        </ul>

        <?php post_navigation(); ?>

    <?php else : ?>
        <h2><?php _e('Nothing Found','html5reset'); ?></h2>
    <?php endif; ?>
</div>