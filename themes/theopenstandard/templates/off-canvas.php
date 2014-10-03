<?php
    $featured_term_id = get_category_by_slug('featured')->term_id;
    $uncategorized_term_id = get_category_by_slug('uncategorized')->term_id;
    $sponsored_term_id = get_category_by_slug('sponsored')->term_id;

    $categories = get_terms('category', array('hide_empty' => false, 'exclude' => array($featured_term_id, $uncategorized_term_id, $sponsored_term_id)));
?>

<aside class="left-off-canvas-menu">
    <!-- NAV -->
    <form class='search' method='post'><input type='hidden' name='form-name' value='form 1' />
        <div class="row">
            <div class="medium-12 columns">
                <input type="search" placeholder="Search The Open Standard">
            </div>
        </div>
    </form>
    <ul class="nav">
        <?php
        foreach ($categories as $category) { 
            $category_posts = get_category_posts(array('cat' => $category->term_id, 'posts_per_page' => 3)); ?>
            <li class="nav-item">
                <div class="topics-tag-normal <?php echo $category->slug; ?>">
                    <a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a>
                </div>
                <ul class="nav-item-list">
                    <?php 
                    while ($category_posts->have_posts()): 
                        $category_posts->the_post(); ?>
                        <li><a href="<?php get_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php 
                    endwhile; ?>
                </ul>
            </li>
        <?php
        } ?>

        <li>
            <ul class="social-icon-links inline-list">
                <li><a href="#"><img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/a2e1b1fb30d095212b505fbc74e7ff6e9fa47c06/social-twitter.svg"></a></li>
                <li><a href="#"><img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/8930e95d705cd0669eb01ee3d53552220d521513/social-facebook.svg"></a></li>
                <li><a href="#"><img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/2269641b25f1cb8652c7219f66d53accb3fb80d6/social-google-plus.svg"></a></li>
            </ul>
        </li>
    </ul>
</aside>