<?php
$author_slug = $modal_args[0];
$authordata = get_user_by('slug', $author_slug);
$author_id = $authordata->ID;

$author_posts = new WP_Query(array(
    'author_name' => $author_slug,
    'posts_per_page' => -1,
    'orderby' => 'date'
));
?>

<div class="close-button">
  <a data-modal-close href="#"><img src="<?php theme_image_src('x.svg'); ?>"></a>
</div>

<div class="overlay header">
    <div class="row">
        <div class="medium-8 medium-offset-3 columns">
            <h1><?php the_author_meta('display_name', $author_id); ?></h1>
        </div>
    </div>
</div>

<section class="body">
    <div class="row">
        <div class="author-bio small-12 medium-2 medium-offset-1 columns">
            <img src="<?php echo get_wp_user_avatar_src(get_the_author_meta('ID', $author_id), 150); ?>" class="author-bio-image">

            <ul class="social-icon-links inline-list">
                <?php if (get_the_author_meta('twitter', $author_id)): ?>
                    <li><a href="<?php the_author_meta('twitter', $author_id); ?>"><img src="<?php theme_image_src('icons/social-twitter-grey.svg'); ?>"></a></li>
                <?php endif; ?>
                <?php if (get_the_author_meta('facebook', $author_id)): ?>
                    <li><a href="<?php the_author_meta('facebook', $author_id); ?>"><img src="<?php theme_image_src('icons/social-facebook-grey.svg'); ?>"></a></li>
                <?php endif; ?>
                <?php if (get_the_author_meta('googleplus', $author_id)): ?>
                    <li><a href="<?php the_author_meta('googleplus', $author_id); ?>"><img src="<?php theme_image_src('icons/social-google-plus-grey.svg'); ?>"></a></li>
                <?php endif; ?>
            </ul>
            <ul class="tag-list">
<!--                 <?php
                $author_posts = new WP_Query(array(
                    'author' => $author_id,
                    'posts_per_page' => -1
                ));

                $categories = array();

                while ($author_posts->have_posts()): 
                    $author_posts->the_post(); 
                    $post_categories = get_post_categories($post);
                    foreach ($post_categories as $post_category) {
                        $categories[$post_category->slug] = $post_category;
                    }
                endwhile;

                foreach ($categories as $category) { ?>
                    <li><a href="/search?cat=<?php echo $category->slug; ?>&author=<?php the_author_meta('user_nicename', $author_id); ?>" class="topics-tag-minimal <?php echo $category->slug; ?>"><?php echo $category->name; ?></a></li>
                <?php
                } ?> -->
            </ul>
            <a href="#" data-modal data-modal-content="authors">See all Authors &gt;</a>
        </div>
        <div class="medium-8 columns left">
            <p class="lead"><?php the_author_meta('description', $author_id); ?></p>

            <ul class="recent-articles">
                <?php 
                while ($author_posts->have_posts()): 
                    $author_posts->the_post(); 
                    $categories = get_post_categories($post); ?>
                    <li class="recent-articles-item <?php echo has_post_thumbnail() ? 'has-thumbnail' : ''; ?>">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(array(80,80), array('class' => 'thumbnail')); ?>
                            <h3><?php echo one_of(simple_fields_fieldgroup('short_title'), get_the_title()); ?></h3>
                        </a>
                        <p><?php the_excerpt(); ?></p>
                        <p>
                            <?php
                            foreach ($categories as $category) { ?>
                                <a href="<?php echo get_category_link($category->term_id); ?>" class="topics-tag-minimal <?php echo $category->slug; ?>"><?php echo $category->name; ?></a>
                            <?php
                            } ?>
                            <span class="timestamp"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span>
                        </p>
                    </li>
                <?php 
                endwhile; ?>
            </ul>
        </div>
    </div>
</section>