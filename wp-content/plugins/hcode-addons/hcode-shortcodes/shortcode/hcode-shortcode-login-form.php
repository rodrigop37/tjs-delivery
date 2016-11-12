<?php
/**
 * Shortcode For Login Form
 *
 * @package H-Code
 */
?>
<?php
/*-----------------------------------------------------------------------------------*/
/* Login Form */
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'hcode_login_form_shortcode' ) ) {
    function hcode_login_form_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'class' => '',
            'hcode_login_form_style' => '',
            'padding_setting' => '',
            'desktop_padding' => '',
            'custom_desktop_padding' => '',
            'ipad_padding' => '',
            'mobile_padding' => '',
            'margin_setting' => '',
            'desktop_margin' => '',
            'custom_desktop_margin' => '',
            'ipad_margin' => '',
            'mobile_margin' => '',
            'uname' => '',
            'password' => '',
            'email' => '',
            'remember' => '',
            'button_text' => '',
        ), $atts ) );
        
        $output = $padding = $margin = $padding_style = $margin_style = $style_attr = $style = '';
        $id = ($id) ? 'id='.$id : '';
        $class = ($class) ? ' '.$class : ''; 
        $hcode_login_form_style = ( $hcode_login_form_style ) ? $hcode_login_form_style : '';
        $uname = ( $uname ) ? $uname : '';
        $password = ( $password ) ? $password : '';
        $email = ( $email ) ? $email : '';
        $remember = ( $remember ) ? $remember : '';
        $button_text = ( $button_text ) ? $button_text : '';
        
        // Column Padding settings
        $padding_setting = ( $padding_setting ) ? $padding_setting : '';
        $desktop_padding = ( $desktop_padding ) ? ' '.$desktop_padding : '';
        $ipad_padding = ( $ipad_padding ) ? ' '.$ipad_padding : '';
        $mobile_padding = ( $mobile_padding ) ? ' '.$mobile_padding : '';
        $custom_desktop_padding = ( $custom_desktop_padding ) ? $custom_desktop_padding : '';
        if($desktop_padding == ' custom-desktop-padding' && $custom_desktop_padding){
                $padding_style .= " padding: ".$custom_desktop_padding.";";
        }else{
                if( $desktop_padding ){
                    $padding .= $desktop_padding; 
                }else{ 
                    $padding .= '' ;
                }
        }
        $padding .= $ipad_padding.$mobile_padding;

        // Column Margin settings
        $margin_setting = ( $margin_setting ) ? $margin_setting : '';
        $desktop_margin = ( $desktop_margin ) ? ' '.$desktop_margin : '';
        $ipad_margin = ( $ipad_margin ) ? ' '.$ipad_margin : '';
        $mobile_margin = ( $mobile_margin ) ? ' '.$mobile_margin : '';
        $custom_desktop_margin = ( $custom_desktop_margin ) ? $custom_desktop_margin : '';
        if($desktop_margin == ' custom-desktop-margin' && $custom_desktop_margin){
                $margin_style .= " margin: ".$custom_desktop_margin.";";
        }else{
                if( $desktop_margin ){
                $margin .= $desktop_margin ;
                }else{ 
                    $margin .= '' ;
                }
        }
        $margin .= $ipad_margin.$mobile_margin;

        // Padding and Margin Style Combine
        if($padding_style){
                $style_attr .= $padding_style;
        }
        if($margin_style){
                $style_attr .= $margin_style;
        }
        
        if($style_attr){
            $style .= ' style="'.$style_attr.'"';
        }
        
        switch ($hcode_login_form_style){
        case 'login-style1':
            $output .= '<div'.$id.' class="login-box bg-white'.$class.$padding.$margin.'"'.$style.'>';
            //Form Title
            $output .= '<h1>Login</h1>';
            //Form Sub Title
            $output .= '<p class="text-uppercase margin-three no-margin-bottom">Enter to account or <a href="'.home_url().'/wp-login.php?action=register">Register Now</a></p>';
            $output .= '<!-- end form sub title  -->';
            $output .= '<div class="separator-line bg-black no-margin-lr margin-ten"></div>';
                $output .= '<form name="loginform" id="loginform" action="'.home_url().'/wp-login.php" method="post">';
                    $output .= '<div class="form-group no-margin-bottom">';
                        // Label Start
                        if($uname):
                            $output .= '<label class="text-uppercase" for="user_login">'.$uname.'</label>';
                        endif;
                        // Label End
                        $output .= '<input type="text" id="user_login" name="log">';
                    $output .= '</div>';
                    $output .= '<div class="form-group no-margin-bottom">';
                        // Label Start
                        if($password):
                            $output .= '<label class="text-uppercase" for="user_pass">'.$password.'</label>';
                        endif;
                        // Label End
                        $output .= '<input type="password" id="user_pass" name="pwd">';
                    $output .= '</div>';
                    $output .= '<div class="checkbox margin-five">';
                        // Checkbox
                        if($remember):
                            $output .= '<label><input type="checkbox" name="rememberme" id="rememberme" value="forever"> '.$remember.'</label>';
                        endif;
                    $output .= '</div>';
                    $output .= '<input type="hidden" name="redirect_to" value="'.$_SERVER['REQUEST_URI'].'">';
                    if($button_text):
                        $output .= '<button type="submit" class="btn btn-black no-margin-bottom btn-small btn-round no-margin-top">'.$button_text.'</button>';
                    endif;
                $output .= '</form>';
            $output .= '</div>';
        break;

        case 'login-style2':
            $output .= '<form name="loginform" '.$id.' action="'.home_url().'/wp-login.php" method="post" class="loginform'.$class.$padding.$margin.'"'.$style.'>';
                $output .= '<div class="form-group no-margin-bottom">';
                    // Label Start
                    if($uname):
                        $output .= '<label class="text-uppercase" for="user_login">'.$uname.'</label>';
                    endif;
                    // Label End
                    $output .= '<input type="text" class="input-round big-input" id="user_login" name="log">';
                $output .= '</div>';
                $output .= '<div class="form-group no-margin-bottom">';
                    // Label Start
                    if($password):
                        $output .= '<label class="text-uppercase" for="user_pass">'.$password.'</label>';
                    endif;
                    // Label End
                    $output .= '<input type="password" class="input-round big-input" id="user_pass" name="pwd">';
                $output .= '</div>';
                if($button_text):
                    $output .= '<button type="submit" class="btn highlight-button-dark btn-small btn-round margin-five no-margin-right">'.$button_text.'</button>';
                endif;
                $output .= '<a class="display-block text-uppercase" href="'.wp_lostpassword_url().'">Forgot Password?</a>';
            $output .= '</form>';
        break;
        
        case 'register':
                // Registration
                $output .= '<div id="register-form'.$class.$padding.$margin.'"'.$style.'>'; 
                    $output .= '<form action="'.site_url('wp-login.php?action=register', 'login_post').'" method="post">';
                        $output .= '<div class="form-group no-margin-bottom">';
                            // Label Start
                            if($uname):
                                $output .= '<label class="text-uppercase">'.$uname.'</label>';
                            endif;
                            // Label End
                            $output .= '<input type="text" class="input-round big-input" id="user_login" name="user_login">';
                        $output .= '</div>';
                        $output .= '<div class="form-group no-margin-bottom">';
                            // Label Start
                            if($email):
                            $output .= '<label class="text-uppercase">'.$email.'</label>';
                            endif;
                            // Label End
                            $output .= '<input type="text" class="input-round big-input" id="user_email" name="user_email">';
                        $output .= '</div>';
                        $output .= do_action('register_form');
                        if($button_text):
                            $output .= '<button type="submit" class="btn highlight-button-dark btn-small btn-round margin-five no-margin-right" id="register">'.$button_text.'</button>';
                        endif;
                        $output .= '<p class="display-block text-uppercase">A password will be e-mailed to you.</p>';
                    $output .= '</form>';
                $output .= '</div>';
        break;
        }
        return $output;
    }
}
add_shortcode( 'hcode_login_form', 'hcode_login_form_shortcode' );
?>