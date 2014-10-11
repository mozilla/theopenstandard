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
                    <?php if(get_post(get_post_thumbnail_id())->post_excerpt) {
                        echo '<div class="post-thumbnail-caption">' . get_post(get_post_thumbnail_id())->post_excerpt . '</div>';
                        }
                    ?>

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

            <!-- LARGER ISSUES -->
            <div class="larger-issues">
                <?php // get_related_posts(); ?>
                <ul class="medium-block-grid-3">
                    <li class="featured-articles-item">  
                        <div class="topics-tag-normal live">
                            <a href="#">Live</a>
                        </div>
                        <img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/ac61739df1ec3320c7d2d97173d7820d59dde83d/apple_600.jpg">
                        <a href="#"><h3>Apple forces users to download a U2 album</h3></a>
                    </li>
                    <li class="featured-articles-item">  
                        <div class="topics-tag-normal learn">
                            <a href="#">Learn</a>
                        </div>
                        <img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/9e24dc625c8f312d099a56f124175cbe3f723cbf/facebook_600.jpg">
                        <a href="#"><h3>Girl Code LA showes women how to get started in tech</h3></a>
                    </li>
                    <li class="featured-articles-item">  
                        <div class="topics-tag-normal innovate">
                            <a href="#">Innovate</a>
                        </div>
                        <img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/a4099f83587a3f78870c1e14bfdde56a6c679f36/googleglass_600.jpg">
                        <a href="#"><h3>Facebook's tracking more than you think</h3></a>
                    </li>
                </ul>
            </div>
               
            <hr class="tall">

            <?php comments_template(); ?>

        </div>
    </div>

   
    <?php 
    $prev = get_previous_post(true);
    $next = get_next_post(true);

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
        $next_category = get_primary_category($next); ?>
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