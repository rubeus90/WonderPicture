<?php
namespace Library;

trait Validator{

	//Retourne faux également si $var = 0
	function exist($var){ 
		return !empty($var);
	}

    function isValidString($var){
		return (is_string($var) && !empty($var)) ? true : false;
	}

	function toString($str){
		return htmlspecialchars($str);
	}

	function isValidMail($mail){
		$regex = "#^[a-z0-9_-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#";
		return (is_string($mail) && !empty($mail) && preg_match($regex,$mail)) ? true : false;
	}

	function isValidURL($url){
		$regex = "#^http\:\/\/[A-Za-z0-9._-]+\.[a-z]{2,6}#";
		return (is_string($url) && !empty($url) && preg_match($regex,$url)) ? true : false;
	}

    function isValidFile($var){
		$fileName = pathinfo($var['name']);
        $fileExtension = $fileName['extension'];
		$extentionSafe = array('jpg', 'jpeg', 'png');

		return ($var['error'] == 0 && in_array($fileExtension, $extentionSafe)) ? true : false;		
	}
}
?>
