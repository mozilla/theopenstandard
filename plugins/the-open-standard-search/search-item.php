<li class="recent-articles-item">
    <?php if (has_post_thumbnail()) { ?>
    <div class="thumbnail">
        <?php the_post_thumbnail('thumbnail'); ?>
    </div>
    <?php } ?>
    <a href="<?php the_permalink(); ?>"><h3><?php echo one_of(simple_fields_fieldgroup('short_title'), get_the_title()); ?></h3></a>
    <p><?php the_excerpt(); ?></p>
    <p>
        <?php
        $categories = get_post_categories($post, array('featured', 'sponsored', 'lead'));
        foreach ($categories as $category) { ?>
            <a href="<?php echo get_category_link($category->term_id); ?>" class="topics-tag-minimal <?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
        <?php
        } ?>
        <span class="timestamp"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
    </p>
</li>