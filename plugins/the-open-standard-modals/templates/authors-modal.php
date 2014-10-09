<div class="close-button">
  <a data-modal-close href="#"><img src="<?php theme_image_src('x.svg'); ?>"></a>
</div>

<div class="overlay header">
    <div class="row">
        <div class="medium-8 medium-offset-3 columns">
			<h1>Authors</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="medium-8 medium-centered columns">
		<?php 
		$authors = get_users(array(
			'role' => 'author',
			'fields' => 'ID'
		));

		foreach ($authors as $author_id) {
			include('author-listing-item.php');
		}

		?> 

	</div>
</div>