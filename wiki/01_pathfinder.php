<?php
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
?>