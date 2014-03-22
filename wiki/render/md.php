<?php
/*
	Called to render a page and its title

	$YARCMS_contentString - raw content as a string

	Should set:

		$YARCMS_page_title - the page title
		$YARCMS_page_content - The page content html
*/
		//the markdown library
		include (dirname(__FILE__) . '/../../lib/markdown/Michelf/MarkdownExtra.inc.php');

		$YARCMS_page_content = \Michelf\MarkdownExtra::defaultTransform($YARCMS_contentString); 
		$YARCMS_page_title = getFirstHeading($YARCMS_page_content);
?>