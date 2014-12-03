<?php
/**
 * @package WordPress
 * @subpackage HTML5-Reset-WordPress-Theme
 * @since HTML5 Reset 2.0
 */
 get_header(); ?>

    <?php
    $featured_term_id = get_category_by_slug('featured')->term_id;
    $hp_featured_term_id = get_category_by_slug('hp_featured')->term_id;
    $lead_term_id = get_category_by_slug('hp_lead')->term_id;

    // Get all posts that have the HP Featured category
    $featured_posts = get_posts(array(
        'cat' => $hp_featured_term_id,
        'category__not_in' => array($lead_term_id),
        'posts_per_page' => -1
    ));

    // The hero post
    $lead_posts = get_posts(array(
        'cat' => $lead_term_id
    ));
    $post = $lead_posts[0];
    ?>

    <div class="row collapse">
        <div class="hero-wrapper">
            <a class="hero-image" href="<?php echo the_permalink(); ?>" style="background: url('<?php echo get_post_thumbnail_url('homepage-hero'); ?>') center center/cover no-repeat"></a>
            <div class="hero-post">
                <?php
                $primary_category = get_primary_category($post); ?>
                <div class="topics-tag-normal <?php echo $primary_category->slug; ?>">
                    <a href="<?php echo get_category_link($primary_category->term_id); ?>"><?php echo $primary_category->name; ?></a>
                </div>

                <div class="hero-headline-container">
                    <div class="hero-headline">
                        <a href="<?php the_permalink(); ?>"><h1><?php echo one_of(simple_fields_fieldgroup('short_title'), get_the_title()); ?></h1></a>
                    </div>
                    <div class="lower" data-equalizer="">
                        <script>
                            window.shareUrl = '<?php the_permalink(); ?>';
                            window.shareTitle = '<?php the_title(); ?>';
                        </script>
                        <?php TheOpenStandardSocial::share_links(); ?>

                        <div class="hero-headline-description show-for-medium-up" data-equalizer-watch="">
                            <?php the_excerpt(); ?>
                            <ul class="inline-list">
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
            </div>
        </div>
    </div>    

    <?php $featured_term_ids = array(); ?>
        
    <!-- FEATURED ARTICLES BY TOPIC -->
    <section class="featured">
        <div class="row">
            <div class="medium-12 columns">
                <h2>Featured Articles by Topic</h2>
                <ul class="owl-carousel" id="featuredArticles">
                    <?php 
                    $categories = array(
                        get_term_by('slug', 'live', 'category'),
                        get_term_by('slug', 'learn', 'category'),
                        get_term_by('slug', 'innovate', 'category'),
                        get_term_by('slug', 'engage', 'category'),
                        get_term_by('slug', 'opinion', 'category')
                    );

                    $ordered_featured_posts = array();
                    
                    foreach ($categories as $category) {
                        $found_post = FALSE;
                        foreach ($featured_posts as $i => $featured_post) {
                            $featured_post_categories = get_post_categories($featured_post);
                            
                            $featured_post->categories = $featured_post_categories;

                            $primary_category = get_primary_category($featured_post);

                            if ($category->slug == $primary_category->slug) {
                                $found_post = TRUE;
                                $ordered_featured_posts[] = $featured_post;
                                unset($featured_posts[$i]);
                                break;
                            }
                        }
                        // Fallback to Featured category if HP Featured wasn't set for the current category.
                        if (!$found_post) {
                            $featured_post = get_featured_post_for_category($category->term_id, $featured_term_id, $lead_term_id);
                            if ($featured_post)
                                $ordered_featured_posts[] = $featured_post;
                            
                        }
                    }

                    foreach ($ordered_featured_posts as $post) {
                        $category = get_primary_category($post); ?>

                        <li class="featured-articles-item">  
                            <div class="topics-tag-normal <?php echo $category->slug; ?>">
                                <a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a>
                            </div>
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo get_post_thumbnail_url('homepage-featured'); ?>" />
                                <div class="<?php echo has_category('sponsored') ? ('sponsored-content-container ' . $category->slug)  : ''; ?>">
                                <h3><?php echo one_of(simple_fields_fieldgroup('short_title'), get_the_title()); ?></h3>
                                    <?php
                                    if (has_category('sponsored')) { ?>
                                        <p class="sponsored-content">Sponsored</p>
                                    <?php
                                    } ?>
                                </div>
                            </a>
                        </li>                
                    <?php 
                    }; ?>
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
            <div class="medium-4 large-3 medium-push-8 large-push-9 columns">
                <?php the_around_the_web_menu('Around The Web (Home)'); ?>
            </div>

            <!-- RECENT ARTICLES -->
            <div class="medium-8 medium-pull-4 columns">
                <div class="recent-articles">
                    <a href="#"><h4>Recent Articles</h4></a>
                    
                    <?php
                    // Get all recent posts not in the Featured category.
                    $options = array('category__not_in' => array($featured_term_id, $lead_term_id));
                    $recent_posts = get_posts($options);
                    ?>
                    <ul>
                        <?php
                        foreach ($recent_posts as $post) { 
                            $primary_category = get_primary_category($post);
                            $categories = get_post_categories($post);
                            ?>

                            <li class="recent-articles-item large-thumb <?php echo $primary_category->slug; ?> <?php echo has_category('sponsored') ? 'sponsored-content-container' : ''; ?> <?php echo has_post_thumbnail() ? 'has-thumbnail' : ''; ?>">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) { ?>
                                    <div class="thumbnail">
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                    </div>
                                    <?php } ?>
                                    
                                    <?php
                                    if (has_category('sponsored')) { ?>
                                        <p class="sponsored-content">Sponsored</p>
                                    <?php
                                    } ?>

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
                        }; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
