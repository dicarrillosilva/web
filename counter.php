<?php

include 'config.php';

/* -------------------------------------------------------------------------- */

//                       HEX TO RGB CONVERTER CODE
function hex2rgb($hex)
{
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3)
    {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    }
    else
    {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = array($r, $g, $b);

    return $rgb;
}

//assign variables
$bg_rgb     = hex2rgb(BACKGROUND_COLOUR_HEX);
$txt_rgb    = hex2rgb(TEXT_COLOUR_HEX);
$shadow_rgb = hex2rgb(SHADOW_COLOUR_HEX);

/* -------------------------------------------------------------------------- */
//                           HIT COUNTER CODE

$counter = file_get_contents("count.txt");
$counter = trim($counter);
$counter += 1;
file_put_contents("count.txt", $counter);

/* -------------------------------------------------------------------------- */
//                       IMAGE GENERACTOR CODE
//Path to font file
$font = './' . FONT_TYPE;

//Code to create the bounding box
$bbox   = imagettfbbox(FONT, 0, $font, $counter . IMAGE_TEXT);
$width  = abs($bbox[4] - $bbox[0]);
$height = abs($bbox[5] - $bbox[1]);
$im     = imagecreatetruecolor($width + 1, $height + 2);

//Assigns the converted colours to variables to use within the final image string 
$background       = imagecolorallocate($im, $bg_rgb[0], $bg_rgb[1], $bg_rgb[2]);
$main_text_colour = imagecolorallocate($im, $txt_rgb[0], $txt_rgb[1], $txt_rgb[2]);
$shadow_colour    = imagecolorallocate($im, $shadow_rgb[0], $shadow_rgb[1], $shadow_rgb[2]);
imagefilledrectangle($im, 0, 0, $width, $height + 1, $background);

//Final string piecing together all of the variables to create the image
imagettftext($im, FONT, 0, 1, FONT + 2, $shadow_colour, $font, $counter . IMAGE_TEXT);
imagettftext($im, FONT, 0, 0, FONT + 1, $main_text_colour, $font, $counter . IMAGE_TEXT);

//Output to browser
header('Content-Type: image/png');
imagepng($im);
imagedestroy($im);