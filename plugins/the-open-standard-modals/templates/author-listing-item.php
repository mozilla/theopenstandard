<div class="author-bio small-12 medium-3 columns end">
	<?php $author_data = get_author_data($author); ?>
	<a href="#" data-modal data-modal-content="author" data-modal-query="/<?php echo $author_data->nicename; ?>">
        <?php echo $author_data->avatar; ?>
	    <p><?php echo $author_data->name; ?></p>
	</a>
	<ul class="social-icon-links inline-list">
        <?php if ($author_data->twitter): ?>
            <li><a href="<?php echo $author_data->twitter; ?>"><img src="<?php theme_image_src('icons/social-twitter-grey.svg'); ?>"></a></li>
        <?php endif; ?>
        <?php if ($author_data->facebook): ?>
            <li><a href="<?php echo $author_data->facebook; ?>"><img src="<?php theme_image_src('icons/social-facebook-grey.svg'); ?>"></a></li>
        <?php endif; ?>
        <?php if ($author_data->googleplus): ?>
            <li><a href="<?php echo $author_data->googleplus; ?>"><img src="<?php theme_image_src('icons/social-google-plus-grey.svg'); ?>"></a></li>
        <?php endif; ?>
	</ul>
</div>