<?php
	/*
		Called to render a page. 

		$YARCMS_page_title - the page title

		YARCMS_page_menu() - Print ths menu

		$YARCMS_page_content - The page content
	*/
?><!DOCTYPE html>
<html>
<head>
	<title><?php echo $YARCMS_page_title; ?> - YarCMS</title>
</head>
<body>

	<?php YARCMS_page_menu(); ?>

	<?php echo $YARCMS_page_content; ?>
</body>
</html>