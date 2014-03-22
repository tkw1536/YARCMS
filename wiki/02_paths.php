<?php

	$YARCMS_contentPath = abspath($YARCMS_contentDir . $YARCMS_pageId);
	$YARCMS_contentDirectory = false;
	$YARCMS_404pageId = false;  
	$YARCMS_IndexPath = false; 

	if(is_dir($YARCMS_contentPath)){

		$YARCMS_contentDirectory = $YARCMS_contentPath;
		$YARCMS_contentPath = $YARCMS_contentPath . "/index";
		$YARCMS_IndexPath = $YARCMS_pageId . "/index"; 
	} else {
		$YARCMS_contentDirectory = abspath($YARCMS_contentPath . "/../"); 
	}

	//Check for a static file
	//If so, output it and die
	$YARCMS_static_type = YARCMS_get_static($YARCMS_contentPath); 

	if($YARCMS_static_type) {
		header('Content-type: ' . $YARCMS_static_type);
		readfile($YARCMS_contentPath); 
		die(); 
	}

	$YARCMS_renderer = YARCMS_get_renderer($YARCMS_contentPath); 
	
	$YARCMS_404 = -1; 

	if($YARCMS_renderer == -1){
		$YARCMS_404 = $YARCMS_pageId; 
		$YARCMS_pageId = YARCMS_get404PageId($YARCMS_pageId); 
		if($YARCMS_pageId == -1){
			$YARCMS_contentPath = dirname(__file__) . "/404_template";
			$YARCMS_renderer = "md"; 
		} else {
			$YARCMS_contentPath = $YARCMS_contentDir . $YARCMS_pageId; 
			$YARCMS_renderer = YARCMS_get_renderer($YARCMS_contentPath);
		}
	}


	$YARCMS_contentPath = $YARCMS_contentPath . "." . $YARCMS_renderer; 
	$YARCMS_contentString = file_get_contents($YARCMS_contentPath);  
?>