<?php
// Licensed under WTF-PL <http://wtfpl.org/>
// Do whatever the fuck you want with this.

// Originally by Flashwave

header('Content-Type: image/png');

$img = imagecreatetruecolor(600, 70);

imagealphablending($img, false);

$rekt = imagecolorallocatealpha($img, 255, 255, 255, 127);
imagefilledrectangle($img, 0, 0, 600, 70, $rekt);

imagealphablending($img, true);

$imgFw	= imagecreatefrompng('kamil.png');
imagecopyresampled($img, $imgFw, 0, 0, 0, 0, 600, 70, 600, 70);

imagealphablending($img, true);

$skype	= file_get_contents('http://mystatus.skype.com/kmil2002.num');
$bgc	= imagecolorallocate($img, 17, 17, 17);
$txtc	= imagecolorallocate($img, 255, 255, 255);
$skypeT	= imagecolorallocate($img, 100, 100, 100);
$font	= imageloadfont('sigfont.gdf');

imagestring($img,	$font, 280, 6, "Skype:  kmil2002",				$txtc);
imagestring($img,	$font, 280, 21, "Site:   http://krakow.pw/",		$txtc);
imagestring($img,	$font, 280, 36, "E-mail: admin@krakow.pw",	$txtc);

if(isset($_GET['r'])) {
	switch($_GET['r']) {
		case 'chatmod':
			$modC = imagecolorallocate($img, 0, 153, 255);
			imagestring($img, $font, 280, 51, "Chat Moderator", $modC);
		break;
		case 'developer':
			$modC = imagecolorallocate($img, 130, 76, 160);
			imagestring($img, $font, 280, 51, "Site Developer", $modC);
		break;
		case 'globalmod':
			$modC = imagecolorallocate($img, 0, 102, 255);
			imagestring($img, $font, 280, 51, "Global Moderator", $modC);
		break;
		case 'admin':
			$modC = imagecolorallocate($img, 170, 0, 0);
			imagestring($img, $font, 280, 51, "Administrator", $modC);
		break;
		case 'banned':
			$modC = imagecolorallocate($img, 46, 46, 46);
			imagestring($img, $font, 280, 51, "Banned", $modC);
		break;
		default:
			$modC = imagecolorallocate($img, 255, 255, 255);
			imagestring($img, $font, 280, 51, "Member", $modC);
		break;
	}
} else {
	$modC = imagecolorallocate($img, 255, 255, 255);
	imagestring($img, $font, 280, 51, "Member", $modC);
}

imagestringup($img,	$font, 555, 58, "Skype",	$skypeT);
imagestringup($img,	$font, 567, 62, "Status",	$skypeT);

switch($skype) {
	case '5': // Do Not Disturb
		$skypeC = imagecolorallocate($img, 255, 0, 0);
		imagestringup($img, $font, 582, 49, "DnD", $skypeC);
	break;
	case '4': // Not Available
	case '3': // Away
		$skypeC = imagecolorallocate($img, 255, 216, 0);
		imagestringup($img, $font, 582, 52, "Away", $skypeC);
	break;
	case '7': // Skype Me
	case '2': // Online
		$skypeC = imagecolorallocate($img, 0, 255, 0);
		imagestringup($img, $font, 582, 62, "Online", $skypeC);
	break;
	case '6': // Invisible
	case '1': // Offline
		$skypeC = imagecolorallocate($img, 255, 0, 0);
		imagestringup($img, $font, 582, 66, "Offline", $skypeC);
	break;
	case '0': // Unknown
	default:
		$skypeC = imagecolorallocate($img, 45, 45, 45);
		imagestringup($img, $font, 582, 66, "Unknown", $skypeC);
	break;
}

imagealphablending($img, false);
imagesavealpha($img, true);

imagepng($img);
imagedestroy($img);
