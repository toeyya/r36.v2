<?php
class Captcha{
	
	public $size;
	public $session;
	public $chars = 'abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';

	function randStr(){
		$string = NULL;
		for ($i = 0; $i < $this->size; $i++){
			$pos = rand(0, strlen($this->chars)-1);
			$string .= $this->chars{$pos};
		}
		$CI =& get_instance();
		$CI->session->set_userdata($this->session,$string);
		return $string;
	}

	function display2(){
		 $width = 26*$this->size; 
		 $height = 50; 
		 $string = $this->randStr(); 
		 $im = imagecreate($width, $height); 
		 $imBG = imagecreatefromjpeg(dirname(__FILE__) . "/captcha/images/captcha.jpg");
		 $bg = imagecolorallocate($im, 255, 255, 255); 
		 $black = imagecolorallocate($im, 0, 0, 0); 
		 $grey = imagecolorallocate($im, 170, 170, 170); 
		 //imagerectangle($im,0, 0, $width-1, $height-1, $grey); 
		 $font = imageloadfont(dirname(__FILE__) . "/captcha/font/anonymous.gdf");
		 imagestring($im, $font , $this->size, 5, $string, $black);
		 imagecopymerge($im, $imBG, 0, 0, 0, 0, 256, 256, 55);
		 imagepng($im); 
		 //imagedestroy($im); 
	}
	
	function display()
	{
		header("Content-Type: image/png");

		$size = 4;
		$width = 26*$size; 
		$height = 50; 
		$string = '134234' ;
		$im = @imagecreate($width, $height) or die("Cannot Initialize new GD image stream");
		$imBG = imagecreatefromjpeg(APPPATH . "libraries/captcha/images/captcha.jpg");
		$bg= imagecolorallocate($im, 255, 255, 255);
		$black = imagecolorallocate($im, 0, 0, 0); 
		$grey = imagecolorallocate($im, 170, 170, 170); 
		imagerectangle($im,0, 0, $width-1, $height-1, $grey); 
		$font = imageloadfont(APPPATH . "libraries/captcha/font/anonymous.gdf");
		imagestring($im, $font, $size, 5,  "2342", $black);
		imagecopymerge($im, $imBG, 0, 0, 0, 0, 256, 256, 55);
		imagepng($im);
		imagedestroy($im);
	}
}
?>