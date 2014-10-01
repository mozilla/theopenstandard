<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="story header">
        <div class="row">
            <div class="medium-8 medium-centered columns">
                <h1 class="title innovate"><?php the_title(); ?></h1>
                <hr>
                <ul class="inline-list">
                    <li><?php the_date('F j, Y'); ?></li>
                    <?php
                    $categories = get_post_categories($post, 'featured');
                    foreach ($categories as $category) { ?>
                        <li class="topics-tag-short <?= $category->slug; ?>"><a href="<?= get_tag_link($tag->term_id); ?>"><?= $category->name; ?></a></li>
                    <?php
                    } ?>

                    <?php
                    $tags = get_the_tags();
                    foreach ($tags as $tag) { ?>
                        <li class="issues-tag"><a href="<?= get_tag_link($tag->term_id); ?>" class="issues-<?= $tag->slug; ?>"><?= $tag->name; ?></a></li>
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
                <img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/229c5c3da2fd50537627c1d38192fb58b31497e6/googleglass_790.jpg" class="key-img">
                <div class="social" data-equalizer-watch="">
                    <?php // TheOpenStandardSocial::share_links(); ?>
                    <span class="tw"></span>
                    <span class="fb"></span>
                    <span class="g"></span>
                </div>

                <div class="author-icon">
                    <hr>
                    <img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/e3bcff5e9fd99da95dd0da444a99cd8468bcdced/author.jpg">
                    <p>Rhodri Marsden</p>
                </div>
            </div>
            <!-- DECK -->
            <h2 class="deck">Other gadgets that don't announce their presence so obviously will continue to do the actual surveillance, argues Rhodri Marsden</h2>
            
            <hr>

            <?php the_content(); ?>

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

            <?php edit_post_link(__('Edit this entry','html5reset'),'','.'); ?>
            
        </div>
    </div>

    <?php previous_post_link('<div class="arrow-left">%link</div>', '<img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/c60a9e20e740db664abf7fb5bbb87a92a34bc348/arrow-left.svg">', true); ?>
    
    <?php next_post_link('<div class="arrow-right">%link</a>', '<img src="http://5c4cf848f6454dc02ec8-c49fe7e7355d384845270f4a7a0a7aa1.r53.cf2.rackcdn.com/assets/images/c60a9e20e740db664abf7fb5bbb87a92a34bc348/arrow-right.svg">', true); ?>

    <?php comments_template(); ?>

<?php endwhile; endif; ?>

<?php get_footer(); ?>