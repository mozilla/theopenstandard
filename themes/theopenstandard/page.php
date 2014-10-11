<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="story header">
        <div class="row">
            <div class="medium-8 medium-centered columns">
                <h1 class="title innovate"><?php the_title(); ?></h1>
                <hr>
            </div>
        </div>
    </div>

    <div class="row story">
        <div class="medium-8 medium-centered columns">
            <!-- STORY HEADER -->
            <div class="story-header">
                <img src="<?php echo get_post_thumbnail_url('single-hero'); ?>" class="key-img">

                <?php TheOpenStandardSocial::share_links(); ?>
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
        $prev_category = get_primary_category($prev); ?>
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

<div class="row">
    <div class="medium-8 medium-centered columns">

        <?php if (have_posts()): while (have_posts()): the_post(); ?>
                
            <article class="post" id="post-<?php the_ID(); ?>">

                <h1><?php echo one_of(simple_fields_fieldgroup('short_title'), get_the_title()); ?></h1>

                <div class="entry">
                    <?php the_content(); ?>
                    <?php wp_link_pages(array('before' => __('Pages: ','html5reset'), 'next_or_number' => 'number')); ?>
                </div>

                <?php edit_post_link(__('Edit this entry','html5reset'), '<p>', '</p>'); ?>

            </article>
            
        <?php endwhile; endif; ?>
    </div>
</div>

<?php get_footer(); ?>
