<?php
	$gallery = simple_fields_fieldgroup('gallery', $gallery_id);
	$post_id = url_to_postid($_SERVER[REQUEST_URI]);
?>

<section class="gallery">
<?php
foreach ($gallery as $gallery_item) { ?>
	<div class="thumbnail" style="background-image: url('<?php echo $gallery_item['image']['image_src']['thumbnail'][0]; ?>');">
		<?php
		$modal_query = "/$post_id/$gallery_id/" . $gallery_item['image']['id'];
		?>
		<a href="?modal=<?php echo $modal_query; ?>" class="view" data-modal data-modal-content="gallery" data-modal-query="<?php echo $modal_query; ?>"></a>
	</div>
<?php
} ?>
</section>