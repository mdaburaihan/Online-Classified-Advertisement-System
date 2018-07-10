<?php
session_start();
$ranStr = md5(microtime());
$ranStr = substr($ranStr, 0, 6);
$_SESSION['cap_code'] = $ranStr;
$newImage = imagecreatefromjpeg("Images/cap_bg.jpg");
$txtColor = imagecolorallocate($newImage, 0, 0, 0);
imagestring($newImage, 5, 20, 10, $ranStr, $txtColor);
header("Content-type: image/jpg");
imagejpeg($newImage);
?>