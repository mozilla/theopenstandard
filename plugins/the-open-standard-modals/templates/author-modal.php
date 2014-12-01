<?php
$author_slug = $modal_args[0];
$author = get_user_by('slug', $author_slug);

if ($author) {
    $author_data = get_author_data($author);    

    $author_posts = new WP_Query(array(
        'author_name' => $author_slug,
        'posts_per_page' => -1,
        'orderby' => 'date'
    ));
} else {
    global $coauthors_plus;
    $author = $coauthors_plus->get_coauthor_by('user_nicename', $author_slug, true);
    $author_data = get_author_data($author);

    $author_posts = get_posts_assigned_to_author($author_data->nicename);
}
?>

<div class="close-button">
  <a data-modal-close href="#"><img src="<?php theme_image_src('x.svg'); ?>"></a>
</div>

<div class="overlay header">
    <div class="row">
        <div class="medium-8 medium-offset-3 columns">
            <h1><?php echo $author_data->name; ?></h1>
        </div>
    </div>
</div>

<section class="body">
    <div class="row">
        <div class="author-bio small-12 medium-2 medium-offset-1 columns">
            <?php echo $author_data->avatar; ?>

            <ul class="social-icon-links inline-list">
                <?php if ($author_data->twitter): ?>
                    <li><a href="<?php echo $author_data->twitter; ?>"><img src="<?php theme_image_src('icons/social-twitter-grey.svg'); ?>"></a></li>
                <?php endif; ?>
                <?php if ($author_data->facebook): ?>
                    <li><a href="<?php echo $author_data->facebook; ?>"><img src="<?php theme_image_src('icons/social-facebook-grey.svg'); ?>"></a></li>
                <?php endif; ?>
                <?php if ($author_data->googleplus): ?>
                    <li><a href="<?php echo $author_data->googleplus; ?>"><img src="<?php theme_image_src('icons/social-google-plus-grey.svg'); ?>"></a></li>
                <?php endif; ?>
            </ul>
            <a href="authors" data-modal data-modal-content="authors">See all Authors &gt;</a>
        </div>
        <div class="medium-8 columns left">
            <p class="lead"><?php echo $author_data->description; ?></p>

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