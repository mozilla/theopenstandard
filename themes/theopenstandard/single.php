<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="story header">
        <div class="row">
            <div class="medium-8 medium-centered columns">
                <?php $categories = get_post_categories($post); ?>
                <?php if (has_category('sponsored')) { ?>
                    <div class="sponsored-content-container">
                        <p class="sponsored-content">Sponsored</p>
                <?php } ?>

                <h1 class="title innovate"><?php the_title(); ?></h1>

                <?php if (has_category('sponsored')) { ?>
                    </div>
                    <br>
                <?php } else { ?>
                <hr>
                <?php } ?>

                <ul class="inline-list">
                    <li><?php the_date('F j, Y'); ?></li>
                    <?php
                    foreach ($categories as $category) { ?>
                        <li class="topics-tag-short <?php echo $category->slug; ?>"><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a></li>
                    <?php
                    } ?>

                    <?php
                    $tags = get_the_tags();
                    foreach ($tags as $tag) { ?>
                        <li class="issues-tag"><a href="<?php TheOpenStandardIssues::the_issues_link($tag->slug); ?>" class="issues-<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                    <?php
                    } ?>  
                </ul>
            </div>
        </div>
    </div>

    <div class="row story">
        <div class="medium-8 medium-centered columns">
            <!-- STORY HEADER -->
            <div class="story-header">
                <img src="<?php echo get_post_thumbnail_url('single-hero'); ?>" class="key-img">
                <div class="post-thumbnail-caption">
                    <?php 
                    if (get_post(get_post_thumbnail_id())->post_excerpt)
                        echo get_post(get_post_thumbnail_id())->post_excerpt; ?> &nbsp;
                </div>

                <?php TheOpenStandardSocial::share_links(); ?>

                <div class="author-icon">
                    <?php
                    $fieldgroup = simple_fields_fieldgroup('sponsor');
                    if ($fieldgroup['url'] && $fieldgroup['logo']['url']) { ?>
                        <hr>
                        <p>Brought to you by</p>
                        <a href="<?php echo $fieldgroup['url']; ?>"><img src="<?php echo $fieldgroup['logo']['url']; ?>"></a></a>
                    <?php
                    } ?>
                    <hr>
                    <a href="#" class="view-author" data-modal data-modal-content="author" data-modal-query="/<?php the_author_nickname(); ?>">
                        <?php echo get_wp_user_avatar(get_the_author_meta('ID'), 150); ?>
                        <p><?php echo get_the_author(); ?></p>
                    </a>
                </div>
            </div>
            <!-- DECK -->
            <h2 class="deck"><?php echo get_the_excerpt(); ?></h2>
            
            <hr>
            
            <div class="post-content">
                <?php the_content(); ?>
            </div>

            <?php edit_post_link(__('Edit this entry','html5reset'),'','.'); ?>

            <hr class="tall">

            <?php echo get_related_posts(); ?>
               
            <?php comments_template(); ?>

        </div>
    </div>

   
    <?php 
    $prev = get_previous_post(true, get_non_primary_category_ids($post));
    $next = get_next_post(true, get_non_primary_category_ids($post));

    if ($prev) {
        $prev_category = get_primary_category($prev); 
        ?>
        <div class="arrow-left <?php echo $prev_category->slug; ?> show-for-large-up">
            <a href="<?php echo post_permalink($prev->ID); ?>">
                <img src="<?php theme_image_src('arrow-left.svg'); ?>">
                <div class="arrow-hover left">
                    <h3 class="<?php echo $prev_category->slug; ?>"><?php echo one_of(simple_fields_fieldgroup('short_title', $prev->ID), get_the_title($prev->ID)); ?></h3>
                </div>
            </a>
        </div>
    <?php
    } ?>


    <?php
    if ($next) { 
        $next_category = get_primary_category($next);
        ?>
        <div class="arrow-right <?php echo $next_category->slug; ?> show-for-large-up">
            <a href="<?php echo post_permalink($next->ID); ?>">
                <img src="<?php theme_image_src('arrow-right.svg'); ?>">
                <div class="arrow-hover right">
                    <h3 class="<?php echo $next_category->slug; ?>"><?php echo one_of(simple_fields_fieldgroup('short_title', $next->ID), get_the_title($next->ID)); ?></h3>
                </div>
            </a>
        </div>
    <?php
    } ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>