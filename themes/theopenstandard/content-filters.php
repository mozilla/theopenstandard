<?php
	require 'vendor/querypath/src/qp.php';

	function startsWith($haystack, $needle) {
		$length = strlen($needle);
		return (substr($haystack, 0, $length) === $needle);
	}

	// Parse out consequtive p::content and put them into block grids.
	function add_block_grids($content) {

		$content = mb_convert_encoding($content, 'utf-8', mb_detect_encoding($content));
		$content = mb_convert_encoding($content, 'html-entities', 'utf-8');

		$content = qp($content);
		$blocks = $content->xpath("//p[starts-with(.,'::')]");

		$block_groups = array();
		$block_group = null;

		foreach ($blocks as $block) {
			$prev = $block->branch()->prev();
			$next = $block->branch()->next();

			$innerHTML = str_replace('::', '', $block->html());

			if ($block_group
				&& (
					count($prev)
					&& startsWith($prev->text(), '::')
				)
			) {
				$block_group->append('<li></li>')->find('li:last-child')->html($innerHTML)->end();
				$block->remove();
			} else {
				$block_group = qp('<ul></ul>', 'ul');
				$block_group->append('<li></li>')->find('li:last-child')->html($innerHTML)->end();
				$block_groups[] = $block_group;
			}
		}

		$blocks = $content->xpath("//p[starts-with(.,'::')]");

		foreach ($blocks as $block) {
			$block_grid = array_shift($block_groups);
			$count = count($block_grid->branch()->find('li'));
			$block_grid->find('ul')->attr('class', "medium-block-grid-$count takeaways innovate");
			$block->replaceWith($block_grid);
		}

		return preg_replace("~<(?:!DOCTYPE|/?(?:html|head|body))[^>]*>\s*~i", '', $content->html());

	}

    add_filter('the_content', 'add_block_grids');
?>
