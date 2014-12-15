<?php
    $post_id = $modal_args[0];
    $gallery_id = $modal_args[1];
    $image_id = $modal_args[2];

    $gallery = simple_fields_fieldgroup('gallery', $gallery_id);

    $post = get_post($post_id);
    $categories = get_post_categories($post);
    $primary_category = get_primary_category($post);
?>

<div class="close-button">
    <a data-modal-close href="#"><img src="<?php theme_image_src('x.svg'); ?>"></a>
</div>

<div class="overlay header">
    <div class="row">
        <div class="medium-8 medium-centered columns">
            <h1>Photo Gallery</h1>
            <h2><?php echo $post->post_title; ?></h2>
            <ul class="inline-list">
                <?php
                foreach ($categories as $category) { ?>
                    <li class="topics-tag-short <?php echo $category->slug; ?>"><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a></li>
                <?php
                } ?>
                
                <?php
                $tags = get_the_tags();
                if (!empty($tags)) {
                    foreach ($tags as $tag) { ?>
                        <li class="issues-tag"><a href="<?php TheOpenStandardIssues::the_issues_link($tag->slug); ?>" class="issues-<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></a></li>
                    <?php
                    } 
                } ?>
            </ul>
        </div>
    </div>
</div>

<section class="body">
    <div class="row">
        <div class="columns">
            <div class="gallery_full">
                <div class="arrow-right <?php echo $primary_category->slug; ?>">
                    <a href="#"><img src="<?php theme_image_src('arrow-right.svg'); ?>"></a>
                </div>
                <?php
                foreach ($gallery as $i => $gallery_item) { 
                    if ($image_id == $gallery_item['image']['id'])
                        $start_image = $i;
                    ?>
                    <div class="full_image" _src="<?php echo $gallery_item['image']['url']; ?>">
                        <p class="caption"><?php echo $gallery_item['image']['post']->post_excerpt; ?></p>
                    </div>
                <?php
                } ?>
                <div class="arrow-left <?php echo $primary_category->slug; ?>">
                    <a href="#"><img src="<?php theme_image_src('arrow-left.svg'); ?>"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="columns medium-2">
            <?php TheOpenStandardSocial::share_links(FALSE); ?>
        </div>
        <div class="columns medium-8">
            <section class="gallery gallery_thumbs">
                <?php
                foreach ($gallery as $gallery_item) { ?>
                    <div class="thumbnail" style="background-image: url('<?php echo $gallery_item['image']['image_src']['thumbnail'][0]; ?>');"></div>
                <?php
                } ?>
            </section>
        </div>
        <script>var gallery = new Gallery('.gallery_full', '.gallery_thumbs', <?php echo $start_image; ?>);</script>
    </div>
</section>