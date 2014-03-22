<?php
	//the file to look for
	$YARCMS_contentPath = abspath($YARCMS_contentDir . $YARCMS_pageId);
	$YARCMS_contentDirectory = false;
	$YARCMS_404pageId = false;  

	if(is_dir($YARCMS_contentPath)){
		$YARCMS_contentDirectory = $YARCMS_contentPath;
		$YARCMS_contentPath = $YARCMS_contentPath . "/index";
	} else {
		$YARCMS_contentDirectory = abspath($YARCMS_contentPath . "/../"); 
	}

	function YARCMS_get_static($content_path){
		if(is_file($content_path)){
			$extension = pathinfo($content_path, PATHINFO_EXTENSION); 

			if(is_file(dirname(__file__).'/static/' . $extension)){
				return file_get_contents(dirname(__file__).'/static/' . $extension); 
			}
		}

		return false; 
	}

	function YARCMS_get_renderer($content_path){
		//get the given renderer for a path
		foreach(glob(dirname(__file__).'/render/*.*') as $file) {
		   	if(endsWith($file, ".php")){
		   		//get only the extension
				$extension = substr($file, strlen(dirname(__file__).'/render/'), strlen($file) - strlen(dirname(__file__).'/render/') - 4); 
		   		if(is_file($content_path . "." . $extension)){
		   			return $extension; 
				}
			}
		}

		return -1; 
	}

	function YARCMS_get404PageId($path){
		global $YARCMS_contentDir;

		//resolve the path
		$path = abspath("/" . $path); 

		$renderer = YARCMS_get_renderer($YARCMS_contentDir . "/" . $path . "/404"); 
		if($renderer != -1){
			return $path . "/404"; 
		} else {
			if($path !== "/"){
				return YARCMS_get404PageId(
					$path . "/../"
				); 
			} else {
				return -1; 
			}
		}

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