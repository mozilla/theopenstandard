<?php get_header(); ?>

    <?php
        $category = get_queried_object();
        $featured_term_id = get_category_by_slug('featured')->term_id;

        $featured_posts = new WP_Query(array(
            'category__and' => array($category->term_id, $featured_term_id),
            'posts_per_page' => -1,
            'orderby' => 'date'
        ));
    ?>

    <div class="header">
        <div class="row">
            <div class="medium-8 medium-centered columns text-center">
                <h1><?php echo $category->name; ?></h1>
                <p><?php echo $category->description; ?></p>
                <?php TheOpenStandardSearch::search_form(array('cat' => $category->slug), false); ?>
            </div>
        </div>
    </div>

    <section class="body topics-page">
        <div class="row">
            <!-- FEATURED ARTICLES -->
            <div class="large-5 columns">
                <ul class="featured-articles">
                    <?php 
                    $limit = 3;
                    while ($featured_posts->have_posts()): 
                        $featured_posts->the_post(); 
                        $primary_category = get_primary_category($post);
                        if ($primary_category->term_id != $category->term_id)
                            continue;
                        ?>
                        <li class="featured-articles-item <?php echo $category->slug; ?> <?php echo has_category('sponsored') ? 'sponsored-content-container' : ''; ?>">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large'); ?>
                                <h3><?php echo one_of(simple_fields_fieldgroup('short_title'), get_the_title()); ?></h3>
                            </a>
                            <p><?php the_excerpt(); ?></p>
                            <p><span class="timestamp"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span></p>
                            <?php
                            if (has_category('sponsored')) { ?>
                                <p class="sponsored-content">Sponsored</p>
                            <?php
                            } ?>
                        </li>
                        <?php 
                        $limit--;
                        if (!$limit)
                            break;
                    endwhile; ?>
                </ul>
            </div>
            <!-- RECENT ARTICLES -->
            <div class="large-4 columns">
                <h4>Recent Articles</h4>
                <ul class="recent-articles">
                    <?php
                    $category_posts = new WP_Query(array(
                        'cat' => $category->term_id,
                        'posts_per_page' => -1,
                        'orderby' => 'date'
                    ));

                    $limit = 6;
                    while ($category_posts->have_posts()): 
                        $category_posts->the_post(); 
                        $primary_category = get_primary_category($post);
                        if ($primary_category->term_id == $category->term_id && has_category($featured_term_id))
                            continue;
                        ?>
                        <li class="recent-articles-item <?php echo $category->slug; ?> <?php echo has_category('sponsored') ? 'sponsored-content-container' : ''; ?> <?php echo has_post_thumbnail() ? 'has-thumbnail' : ''; ?>">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(array(80,80), array('class' => 'thumbnail')); ?>
                                <?php
                                if (has_category('sponsored')) { ?>
                                    <p class="sponsored-content">Sponsored</p>
                                <?php
                                } ?>
                                <h3><?php echo one_of(simple_fields_fieldgroup('short_title'), get_the_title()); ?></h3>
                            </a>
                            <p><?php the_excerpt(); ?></p>
                            <p><span class="timestamp"><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></span></p>
                        </li>
                        <?php 
                        $limit--;
                        if (!$limit)
                            break;
                    endwhile; ?>
                </ul>
            </div>
            <!-- FROM AROUND THE WEB -->
            <div class="large-3 columns">
                <?php the_around_the_web_menu('Around The Web (' . $category->name . ')'); ?>
            </div>

        </div>
        <div class="row">
            <div class="medium-8 medium-centered columns text-center">
                <a href="/search?cat=<?php echo $category->slug; ?>">All Articles &gt;</a>
            </div>
        </div>      
    </section>

<?php get_footer(); ?>
