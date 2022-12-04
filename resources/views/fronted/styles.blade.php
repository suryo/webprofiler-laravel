@php
function blanco_hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
    return $rgb;
}

$light_head_color_rgb = blanco_hex2rgb($style->light_head_color);
$light_main_color_rgb = blanco_hex2rgb($style->light_main_color);
$light_back_main_color_rgb = blanco_hex2rgb($style->light_back_main_color);
$light_back_secondary_color_rgb = blanco_hex2rgb($style->light_back_secondary_color);
$dark_head_color_rgb = blanco_hex2rgb($style->dark_head_color);
$dark_main_color_rgb = blanco_hex2rgb($style->dark_main_color);
$dark_back_main_color_rgb = blanco_hex2rgb($style->dark_back_main_color);
$dark_back_secondary_color_rgb = blanco_hex2rgb($style->dark_back_secondary_color);

$css_variables_inline = '
:root{
    --main-font: "'.str_replace("+", " ", $style->font_main).'";
    --heading-font: "'.str_replace("+", " ", $style->font_head).'";

    --light-head-color: '.$style->light_head_color.';
    --light-main-color: '.$style->light_main_color.';
    --light-back-main-color: '.$style->light_back_main_color.';
    --light-back-secondary-color: '.$style->light_back_secondary_color.';
    --light-accent-color: '.$style->light_accent_color.';
    --light-accent-hover-color: '.$style->light_accent_hover_color.';

    --light-head-color-rgb: '.$light_head_color_rgb[0].','.$light_head_color_rgb[1].','.$light_head_color_rgb[2].';
    --light-main-color-rgb: '.$light_main_color_rgb[0].','.$light_main_color_rgb[1].','.$light_main_color_rgb[2].';
    --light-back-main-color-rgb: '.$light_back_main_color_rgb[0].','.$light_back_main_color_rgb[1].','.$light_back_main_color_rgb[2].';
    --light-back-secondary-color-rgb: '.$light_back_secondary_color_rgb[0].','.$light_back_secondary_color_rgb[1].','.$light_back_secondary_color_rgb[2].';

    --dark-head-color: '.$style->dark_head_color.';
    --dark-main-color: '.$style->dark_main_color.';
    --dark-back-main-color: '.$style->dark_back_main_color.';
    --dark-back-secondary-color: '.$style->dark_back_secondary_color.';
    --dark-accent-color: '.$style->dark_accent_color.';
    --dark-accent-hover-color: '.$style->dark_accent_hover_color.';

    --dark-head-color-rgb: '.$dark_head_color_rgb[0].','.$dark_head_color_rgb[1].','.$dark_head_color_rgb[2].';
    --dark-main-color-rgb: '.$dark_main_color_rgb[0].','.$dark_main_color_rgb[1].','.$dark_main_color_rgb[2].';
    --dark-back-main-color-rgb: '.$dark_back_main_color_rgb[0].','.$dark_back_main_color_rgb[1].','.$dark_back_main_color_rgb[2].';
    --dark-back-secondary-color-rgb: '.$dark_back_secondary_color_rgb[0].','.$dark_back_secondary_color_rgb[1].','.$dark_back_secondary_color_rgb[2].';
}'; 
$css_variables_inline = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css_variables_inline );
$css_variables_inline = str_replace( array("\r\n", "\r", "\n", "\t", '; ', '  ', '    ', '    ',': ', ', ','{ ','}.'), array('','','','',';','','','',':',',','{','} .'), $css_variables_inline );
$css_variables_inline = htmlspecialchars($css_variables_inline, ENT_NOQUOTES);
echo '<style>'.$css_variables_inline.'</style>';
@endphp