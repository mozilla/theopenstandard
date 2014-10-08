<?php get_header(); ?>

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
