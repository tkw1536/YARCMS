<?php

	$YARCMS_config_dir = substr($YARCMS_contentDirectory, strlen($YARCMS_contentDir)); 
	$YARCMS_config = -1; 

	$YARCMS_config_dir = "/" . $YARCMS_config_dir; //MAKE SURE TO START WITH A "/"

	while(TRUE){
		$YARCMS_config_file = abspath($YARCMS_contentDir . $YARCMS_config_dir . "/.yarcms"); 
		if(is_file($YARCMS_config_file)){
			$YARCMS_config = json_decode(file_get_contents($YARCMS_config_file), true);
			if(is_array($YARCMS_config)){
				break;
			} 
		}

		//go up one directory
		if($YARCMS_config_dir === "/"){
			//we are done and have checked it
			$YARCMS_config_file = ""; 
			break; 
		}
		$YARCMS_config_dir = abspath($YARCMS_config_dir . "/../");
	}

	if($YARCMS_config == -1){
		$YARCMS_config = json_decode('{"menu":[],"properties":{},"template":"basic"}', true);
	}

	$YARCMS_template = @$YARCMS_config["template"]; 
	if(!$YARCMS_template){
		$YARCMS_template = "basic"; 
	}
	$YARCMS_menu = @$YARCMS_config["menu"];
	if(!is_array($YARCMS_menu)){
		$YARCMS_menu = array(); 
	}
	$YARCMS_contentProperties = @$YARCMS_config["properties"]; 
	if(!is_array($YARCMS_contentProperties)){
		$YARCMS_contentProperties = array(); 
	}

	if(!is_dir($YARCMS_templateDir . $YARCMS_template)){
		die("Missing template: " . $YARCMS_template); 
	}
?>