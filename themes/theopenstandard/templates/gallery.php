<?php
	$gallery = simple_fields_fieldgroup('gallery', $gallery_id);
?>

<section class="gallery">
<?php
foreach ($gallery as $gallery_item) { ?>
	<div class="thumbnail" style="background-image: url('<?php echo $gallery_item['image']['image_src']['thumbnail'][0]; ?>');">
		<a href="#" class="share"></a>
		<a href="gallery/<?= $gallery_id; ?>" class="view" data-modal data-modal-content="gallery" data-modal-query="/<?= $gallery_id; ?>/<?= $gallery_item['image']['id']; ?>"></a>
	</div>
<?php
} ?>
</section>