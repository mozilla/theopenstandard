<form role="search" data-search method="get" class="search" action="<?php if (!$ajaxify): ?><?php echo home_url('/search'); ?><?php endif; ?>">
	<?php
	foreach ($default_search_params as $param_name => $param_value) { ?>
		<input type="hidden" name="<?php echo $param_name; ?>" value="<?php echo $param_value; ?>">
	<?php
	} ?>
	<div class="row">
		<div class="medium-12 columns">
     	   	<input placeholder="Search The Open Standard" type="search" id="search" name="search" value="<?php echo htmlspecialchars($_GET['s']); ?>" />
	    </div>
	</div>
</form>