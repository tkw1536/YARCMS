<?php
/*
	Called to render a page and its title

	$YARCMS_contentString - raw content as a string

	Should set:

		$YARCMS_page_title - the page title
		$YARCMS_page_content - The page content html
*/

		header("Location: ". $YARCMS_contentString, true, 301); 
		exit; 
?>