<?php
    $gallery_id = $modal_args[0];
    $image_id = $modal_args[1];

    $gallery = simple_fields_fieldgroup('gallery', $gallery_id);
?>

<div class="close-button">
  <a data-modal-close href="#"><img src="<?php theme_image_src('x.svg'); ?>"></a>
</div>

<div class="overlay header">
    <div class="row">
        <div class="medium-8 medium-offset-3 columns">
        </div>
    </div>
</div>

<section class="body">
    <div class="row">
        <div class="columns">
            <div class="gallery_full">
                <?php
                foreach ($gallery as $gallery_item) { ?>
                    <div class="full_image" _src="<?= $gallery_item['image']['url']; ?>"></div>
                <?php
                } ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="columns medium-2">
            <?php TheOpenStandardSocial::share_links(); ?>
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
        <script>var gallery = new Gallery('.gallery_full', '.gallery_thumbs');</script>
    </div>
</section>