<?php include 'header-modal.php'; ?>

<div class="row">
    <div class="medium-8 medium-centered columns">
		<div class="authors-listing text-center">
			<h1>Authors</h1>
		</div>
		<?php 
		$authors = get_users(array(
			'role' => 'author',
			'fields' => 'ID'
		));

		foreach ($authors as $author_id) {
			include('templates/author-listing-item.php');
		}

		?> 

	</div>
</div>

<?php include 'footer-modal.php'; ?>