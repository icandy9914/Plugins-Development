<?php

// Function for learning how to add options
// function wpplugin_options() {

//     // $options = [
//     //   'First Name',
//     //   'Second Option',
//     //   'Third Option'
//     // ];
  
//     $options = [];
//     $options['name']      = 'Zac Gordon';
//     $options['location']  = 'Washington, D.C.';
//     $options['sponsor']   = 'Plugin Co.';
  
//     if( !get_option( 'wpplugin_option' ) ) {
//         add_option( 'wpplugin_option', $options );
//     }
//     update_option( 'wpplugin_option', $options );
//     // delete_option( 'wpplugin_option' );
  
//   }
//   add_action( 'admin_init', 'wpplugin_options' );


function wpplugins_settings()
{
    if( ! get_option( 'wpplugin_settings' ))
    {
        add_option( 'wpplugin_settings' );
    }
    add_settings_section( 'wpplugins_settings_section', 'A Plugin Setting Section', 'wpplugins_settings_section_callback', 'wpplugin');
    add_settings_field( 'wpplugins_settings_field', 'My Custom Fields', 'wpplugins_settings_field_callback', 'wpplugin', 'wpplugins_settings_section');
    add_settings_field( 'wpplugins_settings_field_checkbox', __('Checkbox' , 'wpplugin'), 'wpplugins_settings_field_checkbox_callback', 'wpplugin', 'wpplugins_settings_section',array('label'=>'Checkbox label'));
    add_settings_field( 'wpplugins_settings_field_radio', __('Radio' , 'wpplugin'), 'wpplugins_settings_field_radio_callback', 'wpplugin', 'wpplugins_settings_section',array('option_one'=>'Radio 1', 'option_two'=>'Radio 2'));
    add_settings_field( 'wpplugins_settings_field_select', __('Select Dropdown' , 'wpplugin'), 'wpplugins_settings_field_select_callback', 'wpplugin', 'wpplugins_settings_section',array('select_one'=>'Dropdown 1', 'select_two'=>'Dropdown 2'));
    register_setting( 'wpplugin_settings', 'wpplugin_settings' );
}

add_action('admin_init', 'wpplugins_settings');

function wpplugins_settings_section_callback()
{
    esc_html_e( 'Plugin settings section', 'wpplugin' );
}

function wpplugins_settings_field_callback()
{
    $options = get_option( 'wpplugin_settings' );
    $custom_txt = '';
    if(isset($options['custom_txt']))
    {
        $custom_txt = esc_html( $options['custom_txt'] );
    }
    echo '<input type="text" name="wpplugin_settings[custom_txt]" value="' .$custom_txt. '" >';
}

function wpplugins_settings_field_checkbox_callback($args)
{
    $options = get_option( 'wpplugin_settings' );
    $checkbox = '';
    if( isset( $options[ 'checkbox' ]))
    {
        $checkbox = esc_html( $options[ 'checkbox' ] ) ;
    }
    $html = '<input type="checkbox" id="wpplugins_settings_field_checkbox" name="wpplugin_settings[checkbox]" value="1" ' .checked('1',$checkbox , false) . '/>';
    $html .= '&nbsp;';
    $html .= '<label for="wpplugins_settings_field_checkbox"> ' . $args['label'] . '</label>';
    echo $html;
}

function wpplugins_settings_field_radio_callback($args)
{
    $options = get_option( 'wpplugin_settings' );
    $radio = '';
    if( isset( $options[ 'radio' ]))
    {
        $radio = esc_html( $options[ 'radio' ] ) ;
    }
    $html = '<input type="radio" id="wpplugins_settings_field_radio_one" name="wpplugin_settings[radio]" value="1" ' .checked('1',$radio , false) . '/>';
    $html .= '&nbsp;';
    $html .= '<label for="wpplugins_settings_field_radio_one"> ' . $args['option_one'] . '</label>';
    $html .= '&nbsp;';
    $html .= '<input type="radio" id="wpplugins_settings_field_radio_two" name="wpplugin_settings[radio]" value="2" ' .checked('2',$radio , false) . '/>';
    $html .= '&nbsp;';
    $html .= '<label for="wpplugins_settings_field_radio_two"> ' . $args['option_two'] . '</label>';
    
    echo $html;
}


function wpplugins_settings_field_select_callback($args)
{
    $options = get_option( 'wpplugin_settings' );
    $select = '';
    if( isset( $options[ 'select' ]))
    {
        $select = esc_html( $options[ 'select' ] ) ;
    }
    $html = '<select id="wpplugins_settings_field_select" name="wpplugin_settings[select]">';
    $html .= '<option value="' .$args['select_one']. '" '. selected( $select, $args['select_one'], false ) .' >' . $args['select_one'] .'</option>';
    $html .= '<option value="' .$args['select_two']. '" '. selected( $select, $args['select_two'], false ) .'>' . $args['select_two'] .'</option>';
    $html .= '</select>';
    echo $html;
}