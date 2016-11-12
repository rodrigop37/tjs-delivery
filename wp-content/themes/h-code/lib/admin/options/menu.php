<?php
/**
 * Menu Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$this->sections[] = array(
    'icon' => 'el-icon-lines',
    'title' => esc_html__('Menu', 'H-Code'),
    'desc' => esc_html__('Assign menu for header section.', 'H-Code'),
    'fields' => array(
        array(
            'id'       => 'hcode_header_menu',
            'type'     => 'select',
            'data'     => 'menus',
            'title'    => esc_html__( 'Select Menu', 'H-Code' ),
            'subtitle'    => esc_html__( 'You can manage menu using Appearance > Menus', 'H-Code' ),
        ),
    )
);
?>