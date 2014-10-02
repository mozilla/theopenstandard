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
    $featured_posts = get_category_posts(array('cat' => $featured_term_id));
    $featured_posts->the_post();
    ?>

    <div class="row">
        <div class="medium-12 columns">
            <div class="hero-image" style="background: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>') 0 0/cover no-repeat">

                <?php
                $categories = get_post_categories($post, array('featured'));
                foreach ($categories as $category) { ?>
                    <div class="topics-tag-normal <?php echo $category->slug; ?>">
                        <a href="#"><?php echo $category->name; ?></a>
                    </div>
                <?php
                } ?>

                <div class="hero-headline-container">
                    <div class="hero-headline">
                        <a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
                    </div>
                    <div class="lower" data-equalizer="">
                        <div class="social" data-equalizer-watch="">
                            <span class="tw"></span>
                            <span class="fb"></span>
                            <span class="g"></span>
                        </div>
                        <div class="hero-headline-description" data-equalizer-watch="">
                            <?php the_excerpt(); ?>
                            <ul class="inline-list">
                                <?php
                                $tags = get_the_tags();
                                foreach ($tags as $tag) { ?>
                                    <li class="issues-tag"><a href="<?php echo get_tag_link($tag->term_id); ?>" class="issues-<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                                <?php
                                } ?>                            
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    <?php $featured_term_ids = array(); ?>
        
    <!-- FEATURED ARTICLES BY TOPIC -->
    <section class="featured">
        <div class="row">
            <div class="medium-12 columns">
                <h2>Featured Articles by Topic</h2>
                <ul class="medium-block-grid-5">
                    <?php 
                    while ($featured_posts->have_posts()): 
                        $featured_posts->the_post();
                        $category = get_post_categories($post, array('featured'), 1);
                        // Only show one post per category.
                        if (empty($category) || in_array($category->term_id, $featured_term_ids)):
                            continue;
                        else:
                            $featured_term_ids[] = $category->term_id;
                        endif; ?>

                        <li class="featured-articles-item">  
                            <div class="topics-tag-normal <?php echo $category->slug; ?>">
                                <a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a>
                            </div>
                            <img src="<?php echo get_post_thumbnail_url('medium'); ?>" />
                            <div class="<?php echo has_category('sponsored') ? 'sponsored-content-container' : ''; ?>">
                            <a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                <?php
                                if (has_category('sponsored')) { ?>
                                    <p class="sponsored-content">Sponsored</p>
                                <?php
                                } ?>
                            </div>
                        </li>                
                    <?php 
                    endwhile; ?>
                </ul>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="medium-12 columns">
           <hr>
        </div>
    </div>

    <section class="body">
        <div class="row">
            <!-- RECENT ARTICLES -->
            <div class="medium-8 columns">
                <div class="recent-articles">
                    <a href="#"><h4>Recent Articles</h4></a>
                    
                    <?php
                    // Get all recent posts not in the Featured category.
                    $recent_posts = get_category_posts(array('category__not_in' => $featured_term_id));
                    ?>
                    <ul>
                        <?php
                        while ($featured_posts->have_posts()): 
                            $featured_posts->the_post(); ?>

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

                        <?php
                        endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
