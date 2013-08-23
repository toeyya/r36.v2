<?php  	header ("Content-type: image/png"); 
		$handle = ImageCreate (130, 50) or die ("Cannot Create image"); 
		$bg_color = ImageColorAllocate ($handle, 255, 0, 0); 
		ImagePng ($handle); 
?>