<?php

	include dirname(__FILE__) . "/00_util.php";

	$YARCMS_pageId = abspath($_SERVER["REQUEST_URI"]); //page to render
	
	$YARCMS_templateServe = "data/template/"; 
	$YARCMS_contentServe = "data/content/"; 

	$YARCMS_contentDir = abspath(dirname(__FILE__) . "/../" . $YARCMS_contentServe, "/", true); //directory for content files
	$YARCMS_templateDir = abspath(dirname(__FILE__) . "/../" . $YARCMS_templateServe, "/", true); //template directory 

	//find the right path
	include dirname(__FILE__) . "/01_pathfinder.php"; 
	include dirname(__FILE__) . "/02_paths.php"; 

	//render the page contents
	include dirname(__FILE__) . "/render/". $YARCMS_renderer . ".php";

	//read the dirconfig
	include dirname(__FILE__) . "/03_dirconfig.php"; 

	//render the menu
	include dirname(__FILE__) . "/04_menu.php"; 

	//print it using the template
	include $YARCMS_templateDir . $YARCMS_template . "/page.php"; 
?>