<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
 get_header(); ?>

    <?php
        $featured_term_id = get_category_by_slug('featured')->term_id;
        // Get all posts in the Featured category.
        $featured_posts = new WP_Query(array(
            'cat' => $featured_term_id
        )); 
    ?>

    <?php 
    if ($featured_posts->have_posts()): 
        $featured_term_ids = array(); ?>
        <ul>
            <?php 
            while ($featured_posts->have_posts()): 
                $featured_posts->the_post();
                $category = get_post_categories($post, 'featured', 1);
                // Only show one post per category.
                if (empty($category) || in_array($category->term_id, $featured_term_ids)):
                    continue;
                else:
                    $featured_term_ids[] = $category->term_id;
                endif; ?>
                
                <li>
                    <?php the_post_thumbnail('thumbnail'); ?>
                    <a href="<?php get_permalink(); ?>"><?php the_title(); ?></a>
                </li>

            <?php 
            endwhile; ?>
        </ul>
    <?php 
    endif; ?>

    <?php 
    if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="post" id="post-<?php the_ID(); ?>">
            <h2><?php the_title(); ?></h2>

            <?php posted_on(); ?>

            <div class="entry">
                <?php the_content(); ?>
                <?php wp_link_pages(array('before' => __('Pages: ','html5reset'), 'next_or_number' => 'number')); ?>
            </div>

            <?php edit_post_link(__('Edit this entry','html5reset'), '<p>', '</p>'); ?>
        </article>
        
        <?php comments_template(); ?>

    <?php 
    endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
