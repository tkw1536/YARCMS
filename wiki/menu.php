<?php
	function YARCMS_page_menu(){
		global $YARCMS_templateDir;
		global $YARCMS_template;  
		global $YARCMS_menu;

		if(count($YARCMS_menu) == 0){return; }

		include $YARCMS_templateDir . "/" . $YARCMS_template . "/menu_head.php";

		foreach($YARCMS_menu as $YARCMS_menu_entry ){
			$menu_entry_text = $YARCMS_menu_entry[0]; 
			$menu_entry_url = $YARCMS_menu_entry[1]; 
			if($_SERVER["REQUEST_URI"] == $menu_entry_url){
				include $YARCMS_templateDir . "/" . $YARCMS_template . "/menu_entry_active.php";
			} else {
				include $YARCMS_templateDir . "/" . $YARCMS_template . "/menu_entry_inactive.php";
			}
		}

		include $YARCMS_templateDir . "/" . $YARCMS_template . "/menu_foot.php";
	}
?>