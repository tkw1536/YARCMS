<?php

	include dirname(__FILE__) . "/util.php";

	$YARCMS_pageId = abspath($_SERVER["REQUEST_URI"]); //page to render
	

	$YARCMS_contentDir = abspath(dirname(__FILE__) . "/../data/content/", "/", true); //directory for content files
	$YARCMS_templateDir = abspath(dirname(__FILE__) . "/../data/template/", "/", true); //template directory 

	//find the right path
	include dirname(__FILE__) . "/paths.php"; 

	//render the page contents
	include dirname(__FILE__) . "/render/". $YARCMS_renderer . ".php";

	//read the dirconfig
	include dirname(__FILE__) . "/dirconfig.php"; 

	//render the menu
	include dirname(__FILE__) . "/menu.php"; 

	//print it using the template
	include $YARCMS_templateDir . $YARCMS_template . "/page.php"; 
?>