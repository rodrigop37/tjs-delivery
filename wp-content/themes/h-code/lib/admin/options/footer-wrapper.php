<?php
/**
 * Footer Wrapper Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$icons = array('icon-mobile' => 'icon-mobile','icon-laptop' => 'icon-laptop','icon-desktop' => 'icon-desktop','icon-tablet' => 'icon-tablet','icon-phone' => 'icon-phone','icon-document' => 'icon-document','icon-documents' => 'icon-documents','icon-search' => 'icon-search','icon-clipboard' => 'icon-clipboard','icon-newspaper' => 'icon-newspaper','icon-notebook' => 'icon-notebook','icon-book-open' => 'icon-book-open','icon-browser' => 'icon-browser','icon-calendar' => 'icon-calendar','icon-presentation' => 'icon-presentation','icon-picture' => 'icon-picture','icon-pictures' => 'icon-pictures','icon-video' => 'icon-video','icon-camera' => 'icon-camera','icon-printer' => 'icon-printer','icon-toolbox' => 'icon-toolbox','icon-briefcase' => 'icon-briefcase','icon-wallet' => 'icon-wallet','icon-gift' => 'icon-gift','icon-bargraph' => 'icon-bargraph','icon-grid' => 'icon-grid','icon-expand' => 'icon-expand','icon-focus' => 'icon-focus','icon-edit' => 'icon-edit','icon-adjustments' => 'icon-adjustments','icon-ribbon' => 'icon-ribbon','icon-hourglass' => 'icon-hourglass','icon-lock' => 'icon-lock','icon-megaphone' => 'icon-megaphone','icon-shield' => 'icon-shield','icon-trophy' => 'icon-trophy','icon-flag' => 'icon-flag','icon-map' => 'icon-map','icon-puzzle' => 'icon-puzzle','icon-basket' => 'icon-basket','icon-envelope' => 'icon-envelope','icon-streetsign' => 'icon-streetsign','icon-telescope' => 'icon-telescope','icon-gears' => 'icon-gears','icon-key' => 'icon-key','icon-paperclip' => 'icon-paperclip','icon-attachment' => 'icon-attachment','icon-pricetags' => 'icon-pricetags','icon-lightbulb' => 'icon-lightbulb','icon-layers' => 'icon-layers','icon-pencil' => 'icon-pencil','icon-tools' => 'icon-tools','icon-tools-2' => 'icon-tools-2','icon-scissors' => 'icon-scissors','icon-paintbrush' => 'icon-paintbrush','icon-magnifying-glass' => 'icon-magnifying-glass','icon-circle-compass' => 'icon-circle-compass','icon-linegraph' => 'icon-linegraph','icon-mic' => 'icon-mic','icon-strategy' => 'icon-strategy','icon-beaker' => 'icon-beaker','icon-caution' => 'icon-caution','icon-recycle' => 'icon-recycle','icon-anchor' => 'icon-anchor','icon-profile-male' => 'icon-profile-male','icon-profile-female' => 'icon-profile-female','icon-bike' => 'icon-bike','icon-wine' => 'icon-wine','icon-hotairballoon' => 'icon-hotairballoon','icon-globe' => 'icon-globe','icon-genius' => 'icon-genius','icon-map-pin' => 'icon-map-pin','icon-dial' => 'icon-dial','icon-chat' => 'icon-chat','icon-heart' => 'icon-heart','icon-cloud' => 'icon-cloud','icon-upload' => 'icon-upload','icon-download' => 'icon-download','icon-target' => 'icon-target','icon-hazardous' => 'icon-hazardous','icon-piechart' => 'icon-piechart','icon-speedometer' => 'icon-speedometer','icon-global' => 'icon-global','icon-compass' => 'icon-compass','icon-lifesaver' => 'icon-lifesaver','icon-clock' => 'icon-clock','icon-aperture' => 'icon-aperture','icon-quote' => 'icon-quote','icon-scope' => 'icon-scope','icon-alarmclock' => 'icon-alarmclock','icon-refresh' => 'icon-refresh','icon-happy' => 'icon-happy','icon-sad' => 'icon-sad','icon-facebook' => 'icon-facebook','icon-twitter' => 'icon-twitter','icon-googleplus' => 'icon-googleplus','icon-rss' => 'icon-rss','icon-tumblr' => 'icon-tumblr','icon-linkedin' => 'icon-linkedin','icon-dribbble' => 'icon-dribbble');
$this->sections[] = array(
    'icon' => 'fa fa-server',
    'title' => esc_html__('Footer Wrapper', 'H-Code'),
    'fields' => array(
    	array(
            'id'       => 'hcode_enable_footer_wrapper',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Footer Wrapper', 'H-Code'),
            'default'  => false,
            '1'       => 'On',
            '0'      => 'Off',
        ),
        array(
            'id'            => 'hcode_footer_wrapper_phone_icon',
            'type'          => 'select',
            'title'         => esc_html__('Phone Icon', 'H-Code'),
            'options'       => $icons,
            'required'  => array('hcode_enable_footer_wrapper', 'equals', '1'),
        ),
        array(
            'id'       => 'hcode_footer_wrapper_phone_text',
            'type'     => 'text',
            'title'    => esc_html__('Phone Number Text', 'H-Code'),
            'required'  => array('hcode_enable_footer_wrapper', 'equals', '1'),
        ),
        array(
            'id'            => 'hcode_footer_map_icon',
            'type'          => 'select',
            'title'         => esc_html__('Map Icon', 'H-Code'),
            'options'       => $icons,
            'required'  => array('hcode_enable_footer_wrapper', 'equals', '1'),
        ),
        array(
            'id'       => 'hcode_footer_wrapper_map_text',
            'type'     => 'text',
            'title'    => esc_html__('Map Address Text', 'H-Code'),
            'required'  => array('hcode_enable_footer_wrapper', 'equals', '1'),
        ),
        array(
            'id'            => 'hcode_footer_wrapper_email_icon',
            'type'          => 'select',
            'title'         => esc_html__('Email Icon', 'H-Code'),
            'options'       => $icons,
            'required'  => array('hcode_enable_footer_wrapper', 'equals', '1'),
        ),
        array(
            'id'       => 'hcode_footer_wrapper_email_id',
            'type'     => 'text',
            'title'    => esc_html__('Email Address', 'H-Code'),
            'required'  => array('hcode_enable_footer_wrapper', 'equals', '1'),
        ),
    )
);
?>