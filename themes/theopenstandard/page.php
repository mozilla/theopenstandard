<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="story header">
        <div class="row">
            <div class="medium-8 medium-centered columns">
                <h1 class="title"><?php the_title(); ?></h1>
                <hr>
            </div>
        </div>
    </div>

    <div class="row story">
        <div class="medium-8 medium-centered columns">
            <!-- STORY HEADER -->
            <div class="story-header">
                <?php
                if (has_post_thumbnail()) { ?>
                    <img src="<?php echo get_post_thumbnail_url('single-hero'); ?>" class="key-img">
                <?php
                } ?>

                <?php TheOpenStandardSocial::share_links(); ?>
            </div>

            <div class="page-content">
                <?php the_content(); ?>
            </div>

            <?php edit_post_link(__('Edit this entry','html5reset'),'','.'); ?>

            <hr class="tall">

        </div>
    </div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>