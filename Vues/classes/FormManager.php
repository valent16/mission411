<?php

class FormManager{

	public static function beginForm($method, $action, $css_class="", $extraOption=""){
		if (!empty($css_class)){
			$css_class_option= "class=\"".$css_class."\" ";
		}else{
			$css_class_option="";
		}
		return "<form method=\"".$method."\", action=\"".$action."\", ".$css_class_option.$extraOption.">\n";
	}
	
	public static function endForm(){
		return "</form>\n";
	}
	
	public static function addInput($labelText, $type, $name, $id, $value=null, $extraOption="", $noBR=false){
		$returnText="";
		$valueOption=( ($value) == null) ? "" : " value=\"".$value."\" ";
		
		if ($extraOption == null){
			$extraOption="";
		}
		
		if ($labelText!=null && $labelText!=""){
			$returnText .= "<label for=\"".$id."\">".$labelText."</label>\n";
		}
		$returnText .= "<input type=\"".$type."\" name=\"".$name."\" id=\"".$id."\" ".$valueOption." ".$extraOption." />\n";
		return $returnText;
	}
	
	public static function addTextInput($labelText, $name, $id, $size, $value=null, $extraOption=""){
		return self::addInput($labelText,"text",$name,$id,$value, "size=\"".$size."\" ".$extraOption);
	}
	
	public static function addPasswordInput($labelText, $name, $id, $size, $value=null, $extraOption=""){
		return self::addInput($labelText,"password",$name,$id,$value, "size=\"".$size."\" ".$extraOption);
	}
	
	public static function addFileInput($labelText, $name, $id, $size, $value=null, $extraOption=""){
		return self::addInput($labelText,"file",$name,$id,$value, "size=\"".$size."\" ".$extraOption);
	}
	
	public static function addTextAreaInput($labelText, $name, $id, $rows,$cols, $value=null, $extraOption=""){
		$returnText = "";
		$valueOption = ($value == null) ? "" : $value;
		
		if ($extraOption == null){
			$extraOption="";
		}
		$returnText .= "<p>\n";
		
		if ($labelText !=null && $labelText !=""){
			$returnText .= "<label for=\"".$id."\">".$labelText."</label>\n";
		}
		$returnText .= "<textarea name=\"".$name."\" id=\"".$id."\" rows=\"".$rows."\" cols=\"".$cols."\" ".$extraOption.">".$valueOption."</textarea>\n";
		
		$returnText .= "</p>\n";
		return $returnText;
	}
	
	public static function addSubmitButton($value="Envoyer", $extraOption="")
    {
        return self::addInput(null, "submit", "submit", "", $value, " " . $extraOption);
    }
}

?>