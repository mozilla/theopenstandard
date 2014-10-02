<?php
	// The content from the wysiwyg has empty text nodes between tags and I want to ignore them.
	function get_real_previous_sibling($node) {
		if ($node->previousSibling && $node->previousSibling->nodeName == '#text' && ctype_space($node->previousSibling->nodeValue)) {
			return $node->previousSibling->previousSibling;
		}
		return $node->previousSibling;
	}

	// Parse out consequtive p::content and put them into block grids.
	function add_block_grids($content) {
		// DOMDocument seems to have problems with the long dash, this fixes it.
		$content = mb_convert_encoding($content, 'utf-8', mb_detect_encoding($content));
		$content = mb_convert_encoding($content, 'html-entities', 'utf-8'); 

		$document = new DOMDocument('1.0', 'utf-8');
		$document->loadHTML($content);
		$xpath = new DOMXpath($document);

		$blocks = $xpath->query("//p[starts-with(.,'::')]");

		$block_groups = array();
		$block_group = null;

		$last_block = null;
		foreach ($blocks as $block) {
			$previous_sibling = get_real_previous_sibling($block);
			if ($last_block && $previous_sibling && $previous_sibling->isSameNode($last_block)) {
				// We're still in the same block group.
				$block_group[] = $block;
			} else {
				if ($block_group) {
					// We've found a new series of blocks, so start a new array for them.
					$block_groups[] = $block_group;
					$block_group = array($block);
				} else {
					// It's our first group
					$block_group = array($block);
					$block_groups[] = &$block_group;
				}
			}

			$last_block = $block;
		}

		foreach ($block_groups as $block_group) {
			$ul = $document->createElement('ul');

			$count = count($block_group);
			$ul->setAttribute('class', "medium-block-grid-$count takeaways innovate");

			// Insert the UL before the block group p tags
			$block_group[0]->parentNode->insertBefore($ul, $block_group[0]);

			foreach ($block_group as $block) {
				$li = $document->createElement('li');
				$block->nodeValue = str_replace('::', '', $block->nodeValue);
				$li->appendChild($block);
				$ul->appendChild($li);
			}
		}

		return $document->saveHTML();
	}

    add_filter('the_content', 'add_block_grids');
?>