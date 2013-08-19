<?php
session_start();
header("Content-Type: image/png");
$size = 4;
$width = 26*$size; 
$height = 50; 
$string = rand(1111, 9999);
unset($_SESSION["captcha"]); 
$_SESSION['captcha'] = $string;
$im = @imagecreate($width, $height) or die("Cannot Initialize new GD image stream");
$imBG = imagecreatefromjpeg("application/libraries/captcha/images/captcha.jpg");
$bg= imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0); 
$grey = imagecolorallocate($im, 170, 170, 170); 
imagerectangle($im,0, 0, $width-1, $height-1, $grey); 
$font = imageloadfont("application/libraries/captcha/font/anonymous.gdf");
imagestring($im, $font, $size, 5,  $string, $black);
imagecopymerge($im, $imBG, 0, 0, 0, 0, 256, 256, 55);
imagepng($im);
imagedestroy($im);
?>