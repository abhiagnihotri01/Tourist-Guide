<?php

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: image/jpg");
	include_once($_SERVER['DOCUMENT_ROOT'].'/Project/config/Constants.php');
	extract($_GET);
	$url = HTTP.HOST.'/Project/views/images/'.$name;
	// echo $url;
	list($old_width, $old_height) = getimagesize($url);
	$thumb = imagecreatetruecolor($width, $height);
	if(strpos($name, 'png') !== false) {
		$source = imagecreatefrompng($url);
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $width, $height, $old_width, $old_height);
		imagepng($thumb);		
	}
	else {
		$source = imagecreatefromjpeg($url);
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $width, $height, $old_width, $old_height);
		imagejpeg($thumb);		
	}

