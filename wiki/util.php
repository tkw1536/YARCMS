<?php

	include (dirname(__FILE__) . '/../lib/simple_html_dom.php');
	
	function startsWith($haystack, $needle)
	{
	    return $needle === "" || strpos($haystack, $needle) === 0;
	}
	
	function endsWith($haystack, $needle)
	{
	    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
	}

	function splitpath($path, $seperator = "/"){

		if(!startsWith($path, $seperator)){
			$path = dirname(__FILE__) . $seperator . $path; 
		}

		$components = explode($seperator, $path);

		$properArray = array(); 

		foreach($components as $component){
			if($component == ".."){
				if(count($properArray) >  0){
					array_pop($properArray); 
				} else {
					//we can't go higher then the top level path
				}
			} else if($component == "."){
				//do nothing, we stay in the current directory
			} else if($component != ""){
				array_push($properArray, $component); 
			}
			
		}

		return $properArray; 
	}

	function abspath($path, $seperator = "/", $trail = FALSE){

		$properArray = splitpath($path, $seperator); 

		if($trail){
			return $seperator . implode($seperator, $properArray) . $seperator;
		} else {
			return $seperator . implode($seperator, $properArray);
		}
	}

	function pathEquals($a, $b){
		return abspath($a) == abspath($b); 
	}

	function getFirstHeading($text) {
	    $html = str_get_html($text);

	    foreach($html->find("h1") as $element) {
	        return $element->plaintext;
	    }

	    foreach($html->find("h2") as $element) {
	        return $element->plaintext;
	    }

	    foreach($html->find("h3") as $element) {
	        return $element->plaintext;
	    }

	    foreach($html->find("h4") as $element) {
	        return $element->plaintext;
	    }

	    foreach($html->find("h5") as $element) {
	        return $element->plaintext;
	    }

	    foreach($html->find("h6") as $element) {
	        return $element->plaintext;
	    }

	    return "Untitled"; 
	}
?>