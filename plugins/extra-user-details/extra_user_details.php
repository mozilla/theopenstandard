<?php
/*
Plugin Name: Extra User Details
Plugin URI: http://vadimk.com/wordpress-plugins/extra-user-details/
Description: Allows you to add additional fields to the user profile like Facebook, Twitter etc.
Author: Vadym Khukhrianskyi
Version: 0.4.1
Text Domain: extra_user_details
Author URI: http://vadimk.com/
License: GPLv2 or later
*/

add_action( 'plugins_loaded', 'eud_localization_init' );

function eud_localization_init() {
    $path = dirname(plugin_basename(__FILE__)) . '/lang/';

    load_plugin_textdomain( 'extra_user_details', false, $path );
}

if ( ! get_option( 'eud_fields' ) ) add_option( 'eud_fields', '' );

add_action( 'edit_user_profile', 'eud_extract_ExtraFields' );
add_action( 'show_user_profile', 'eud_extract_ExtraFields' );
add_action( 'profile_update', 'eud_update_ExtraFields' );

//Administration
add_action( 'admin_menu', 'eud_plugin_menu' );
add_action( 'init', 'eud_scripts' );
//add_action( 'admin_init', 'add_eud_contextual_help' );

function eud_plugin_menu() {
    $eud_page = add_submenu_page( 'users.php', 'Extra User Details Options', 'Extra User Details', 'edit_users', 'extra_user_details', 'eud_plugin_options' );

    add_action( 'load-' . $eud_page, 'add_eud_contextual_help' );
}

function eud_scripts(){
    wp_enqueue_script( array("jquery", "jquery-ui-core", "jquery-ui-sortable") );
}

/**
 * Prints help info
 *
 * @return void
 * @author Vadimk
 **/
function add_eud_contextual_help() {
  $help = '
    <div id="eud-fields-help">
        <p><strong>' . __( "How to use this plugin:", 'extra_user_details' ) . '</strong></p>
        <p>' . __( "<strong>Meta key</strong>: This is the key to use in templates with <em>get_user_meta('meta_key')</em>. No special characters please, only lowercase letters, '_' and '-' can be used. <strong>NOTE:</strong> If you change this slug later, this will NOT update meta key for existing meta values in DB!", 'extra_user_details'  ) . '</p>
        <p>' . __( "<strong>Field label</strong>: This is the label your users will see on their profile.", 'extra_user_details' ) . '</p>
        <p>' . __( "<strong>Help text</strong>: Description text is showing near the appropriate custom field in user profile.", 'extra_user_details' ) . '<br />' . __( 'The default help text is:', 'extra_user_details') . ' <em>' . __( 'Please fill in this additional profile information field.', 'extra_user_details' ) . '</em></p>
        <p>' . __( "<strong>Access level</strong>: By default extra fields are displayed for all user levels (subscribers, contributors, editors etc.). If you want to restrict some specific field usage, select appropriate users to have some specific extra field.", 'extra_user_details' ) . '</p>
        <p>' . __( "<strong>Field order</strong>: Fields are normally displayed - both here as well as on user profiles - in the order in which they are added. If you would like to change the order in which these extra fields are displayed: simply move the field above or below another one and update settings.", 'extra_user_details' ) . '</p>
        <p>' . __( "<strong>WARNING</strong>: Please remember, you're using this plugin for your own risk and should know what you're doing, because wp_usermeta table contains other meta_keys for another purpose which can be affected (if you set the same slug for your extra field). If you will add two identical fields - the user won't be able to update those fields in profile.", 'extra_user_details' ) . '</p>
        <hr />
        <p><strong style="color:red">Need help?</strong>: Need extra feature/new plugin, your WordPress website support? Contact plugin author <a href="http://vadimk.com/contact/">here</a> or on <a href="http://twitter.com/vaddim">twitter</a>.</p>
        <hr />
        <p>If you want to support development of this plugin please use the button below. Thanks!</p>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post"><input type="hidden" name="cmd" value="_s-xclick" />
            <input type="hidden" name="hosted_button_id" value="XGPUDPPDMA3PE" />
            <input type="image" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" alt="PayPal - The safer, easier way to pay online!" />
            <img src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" alt="" width="1" height="1" border="0" />
        </form>
    </div>';

    $screen = get_current_screen();
    $screen->add_help_tab(array(
        'title'   => 'Help',
        'id'      => 'users_page_extra_user_details',
        'content' => $help,
    ));
}


function eud_extract_ExtraFields() {
    if ( get_option( 'eud_fields' ) ) {

        $all_fields = unserialize( get_option( 'eud_fields' ) );

        if ( count( $all_fields ) > 0 ) {

            $output = '';

            foreach ( $all_fields as $key => $value ) {
              if ( isset($value[3]) && ! empty($value[3]) ) {
                if ( ($value[3] == 'disable') || ! current_user_can($value[3]) ) {
                    continue;
                }
              }
              $output .= '<tr>
                      <th><label for="eud' . esc_attr( $value[1] ) . '">' . esc_attr( $value[0] ) . '</label></th>
                      <td><input name="eud' . esc_attr( $value[1] ) . '" id="eud' . esc_attr( $value[1] ) . '" type="text" value="' . esc_attr( get_user_meta( get_user_id(), $value[1], true ) ) . '" class="regular-text code" />&nbsp;<span class="description">' . ( ( isset( $value[2] ) && $value[2] !== '' ) ? esc_attr( stripslashes( $value[2] ) ) : '' ) . '</span></td>
                    </tr>';
            }
        }

        if ($output != '') {
            echo '<h3>' . __( 'Extra User Details', 'extra_user_details' ) . '</h3>
                <table class="form-table">';
            echo $output;
            echo '</table>';
        }

    }
}

function eud_plugin_options() {

    // ============
    // = Updating =
    // ============
    if ( isset( $_POST['eud_submit'] ) && isset( $_POST['eud_fields'] ) ) {

        $eud_fields = $_POST['eud_fields'];
        $all_fields = array();
        $error_fields = array();

        foreach ( $eud_fields as $key => $value ) {

            if ( isset( $value['0'] ) || isset( $value['1'] ) ) {

                $name = !empty( $value['0'] ) ? $value['0'] : ucfirst( $value['1'] );
                $slug = !empty( $value['1'] ) ? $value['1'] : sanitize_title( $value['0'] );
                $description = !empty( $value['2'] ) ? $value['2'] : '';
                $capability = !empty( $value['3'] ) ? $value['3'] : 'read';

                $eud_fields[$key][0] = $name;
                $eud_fields[$key][1] = $slug;
                $eud_fields[$key][2] = $description;
                $eud_fields[$key][3] = $capability;


                // Validate the field label
                if ( preg_match( '/^[0-9a-z-_]+$/', $slug ) === 1 ) {
                    $all_fields[] = array(
                                        0 => $name,
                                        1 => $slug,
                                        2 => $description,
                                        3 => $capability,
                    );
                } else {
                    $error_fields[] = $key;
                }
            }

        }

        if( count( $all_fields ) > 0) {
            update_option( 'eud_fields', serialize( $all_fields ) );
        } else {
            update_option( 'eud_fields', '' );
        }

        echo '<div class="updated"><p><strong>' . __( 'Extra Fields Options Updated.', 'extra_user_details' ) . '</strong></p></div>';

        if ( count( $error_fields ) )
            echo '<div class="error">
                    <p><strong>' . __( 'However, highlighted fields are not updated because contain errors! Please correct them and update fields again or this fields will be lost.', 'extra_user_details' ) . '</strong></p>
                </div>';

    }


    echo '
    <form action="" method="post">
        <div class="wrap">
            <div class="icon32" id="icon-options-general"></div>
            <h2>' . __( 'Extra User Details Options', 'extra_user_details' ) . '</h2>';

        echo '
            <form action="" method="post">

                <h3>' . __( 'Currently defined fields', 'extra_user_details' ) . '</h3>';

                if ( isset( $eud_fields ) && !empty( $eud_fields ) ) {
                    $all_fields = $eud_fields;
                }

                if ( !isset( $all_fields ) || empty( $all_fields ) ) {
                    $all_fields = get_option( 'eud_fields' );
                    if ( !is_array( $all_fields) ) {
                        $all_fields = unserialize( $all_fields );
                    }
                }

?>
                    <script type='text/javascript'>
                        jQuery(document).ready(function(){

                            jQuery('.sortcontainer').sortable({
                                axis: 'y',
                                items: 'div',
                                stop: function() {
                                    jQuery(this).find('div').each(function(index) {
                                        jQuery(this).find('td:eq(0)').html((index + 1) + '.');
                                    })
                                }
                             });

                            jQuery('.add-field').click(function(){
                                var randnum = Math.floor((Math.random() * (9999-999+1))+999);
                                var append = '<div class="field"><table><tbody><tr><th class="num">&nbsp;</th><th class="slug"><?php _e('Meta Key:', 'extra_user_details');?></th><th class="name"><?php _e('Field Name:', 'extra_user_details');?></th><th class="description"><?php _e( 'Description (Help Text):', 'extra_user_details' );?></th><th class="userlevel"><?php _e('Access Level:', 'extra_user_details');?></th><th class="actions"></th></tr><tr><td>' + (jQuery('.sortcontainer div').size() + 1) + '.</td><td><input name="eud_fields['+ randnum +'][1]" type="text" value="" class="regular-text" size=""/></td><td><input name="eud_fields['+ randnum +'][0]" type="text" value="" class="regular-text" size=""/></td><td><input name="eud_fields['+ randnum +'][2]" type="text" value="" class="regular-text" size="80"/></td><td><select name="eud_fields['+ randnum +'][3]" style="width:100px"><option value="install_themes"><?php _e('Admins Only', 'extra_user_details');?></option><option value="edit_others_posts"><?php _e('Admins, Editors', 'extra_user_details');?></option><option value="publish_posts"><?php _e('Admins, Editors, Authors', 'extra_user_details');?></option><option value="edit_posts"><?php _e('Admins, Editors, Authors, Contributors', 'extra_user_details');?></option><option value="read" selected="selected"><?php _e('Everyone', 'extra_user_details');?></option><option value="disable"><?php _e('Disable', 'extra_user_details');?></option></select></td><td><input type="button" value="<?php _e('Delete', 'extra_user_details');?>" class="delete-field button"></td></tr></tbody></table></div>';
                                jQuery('.sortcontainer').append(append);
                            });

                            jQuery('.delete-field').live('click', function() {
                                var parent = jQuery(this).parents('.field');
                                if (parent.find('input[type=text]').val() == '' || confirm('Are you sure you want to delete this extra field?')) {
                                    parent.remove();
                                }
                                return false;
                            });

                        });
                    </script>

                    <style type='text/css'>
                        .sortcontainer{
                            padding:0 0 5px 0;
                        }
                        .sortcontainer .field{
                            margin:8px 0;
                            cursor:ns-resize;
                        }
                        .sortcontainer .field table{
                            background-color:#f1f1f1;
                            border:1px dotted gray;
                            padding:5px;
                            -moz-border-radius:5px 5px 5px 5px;
                            border-radius:5px 5px 5px 5px;
                        }
                        .sortcontainer .field table.bad-field{
                            background-color:#FFEBE8;
                            border-color:#CC0000;
                        }
                        .sortcontainer .field input.regular-text{
                            width:100%;
                        }
                        .sortcontainer .field th{
                            font-size:10px;
                            font-style:normal;
                        }
                        .sortcontainer .field td{
                            padding:0 5px;
                        }
                        .sortcontainer .num{
                            width:3%;
                        }
                        .sortcontainer .slug{
                            width:15%;
                        }
                        .sortcontainer .name{
                            width:25%;
                        }
                        .sortcontainer .description{
                            width:40%;
                        }
                        .sortcontainer .userlevel{
                          width:10%;
                        }
                        .sortcontainer .actions{
                            width:7%;
                        }
                        .sortcontainer .delete{
                            font-size:11px;
                            font-style:italic;
                            color:#666;
                            float:right;
                        }
                    </style>

                <div class="sortcontainer">
<?php
                if ( is_array( $all_fields ) && count( $all_fields ) > 0 ) {

                    if ( !isset( $error_fields ) ) $error_fields = array();

                    $counter = 0;
                    foreach ( $all_fields as $key => $value ) {
                      if ( !isset($value['3']) || empty($value['3']) ) $value['3'] = 'read';
                        if ( in_array( $key, $error_fields) ) $class = ' class="bad-field"'; else $class = '';
                        echo '
                        <div class="field">
                            <table'.$class.'>
                                <tbody>
                                    <tr>
                                        <th class="num">&nbsp;</th>
                                        <th class="slug">' . __( 'Meta Key:', 'extra_user_details' ) . '</th>
                                        <th class="name">' . __( "Field Name:", "extra_user_details" ) . '</th>
                                        <th class="description">' . __( "Description (Help Text):", "extra_user_details" ) . '</th>
                                        <th class="userlevel">' . __( "Access Level:", "extra_user_details" ) . '</th>
                                        <th class="actions"></th>
                                    </tr>
                                    <tr>
                                        <td>'.++$counter.'.</td>
                                        <td>
                                            <input name="eud_fields[' . esc_attr( $key ) . '][1]" type="text" value="' . esc_attr( $value[1] ) . '" class="regular-text" size="20" />
                                        </td>
                                        <td>
                                            <input name="eud_fields[' . esc_attr( $key ) . '][0]" type="text" value="' . esc_attr( $value[0] ) . '" class="regular-text" size="30" />
                                        </td>
                                        <td>
                                            <input name="eud_fields[' . esc_attr( $key ) . '][2]" type="text" value="' . ( isset( $value[2] ) ? htmlspecialchars( stripslashes( $value[2] ), ENT_NOQUOTES ) : '' ) . '" class="regular-text" size="80" />
                                        </td>
                                        <td>
                                            <select name="eud_fields[' . esc_attr( $key ) . '][3]" style="width:100px">
                                              <option value="install_themes" '.selected( $value[3], 'install_themes', false ).'>'. __('Admins Only', 'extra_user_details') .'</option>
                                              <option value="edit_others_posts" '.selected( $value[3], 'edit_others_posts', false ).'>'. __('Admins, Editors', 'extra_user_details') .'</option>
                                              <option value="publish_posts" '.selected( $value[3], 'publish_posts', false ).'>'. __('Admins, Editors, Authors', 'extra_user_details') .'</option>
                                              <option value="edit_posts" '.selected( $value[3], 'edit_posts', false ).'>'. __('Admins, Editors, Authors, Contributors', 'extra_user_details') .'</option>
                                              <option value="read" '.selected( $value[3], 'read', false ).'>'. __('Everyone', 'extra_user_details') .'</option>
                                              <option value="disable" '.selected( $value[3], 'disable', false ).'>'. __('Disable', 'extra_user_details') .'</option>
                                        </td>
                                        <td>
                                            <input type="button" value="' . __('Delete', 'extra_user_details') . '" onclick="remove_eud_field();" class="delete-field button">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>';

                    }
                    unset( $value );
                }
                    echo '</div>';

                unset( $all_fields );


                echo '
                </div>

                <input type="button" value="' . __( 'Add New Field', 'extra_user_details' ) . '" class="add-field button">

            <p class="submit">
            <input type="submit" name="eud_submit" class="button-primary" value="' . __( 'Update Extra Fields', 'extra_user_details' ) . '">
        </p>
    </form>';
}


/**
 * Updates extra fields. Input validation needed, but we don't know what the user wants to accept...
 *
 * @return void
 * @author Vadimk
 */
function eud_update_ExtraFields() {
    $get_user_id = get_user_id();

    foreach ( $_POST as $key => $value ) {

        if( strpos( $key, 'eud' ) === 0 ) {

            $key = str_replace( 'eud', '', $key );

            if( !empty( $value ) ) {
                eud_update_option( $get_user_id, $key, $value );
            }
            else {
                eud_delete_option( $get_user_id, $key, $value );
            }
        }
    }
}

/**
 * Updates extra field value
 *
 * @param string $get_user_id
 * @param string $eudfield
 * @param string $value
 * @return void
 * @author Vadimk
 */
function eud_update_option( $get_user_id, $eudfield, $value ) {
    if( function_exists( 'update_user_meta' ) ) {
        update_user_meta( $get_user_id, str_replace( 'eud', '', $eudfield ), $value );
    }
    else {
        update_usermeta( $get_user_id, str_replace( 'eud', '', $eudfield ), $value );
    }
}

/**
 * Deletes extra field value if nothing was populated
 *
 * @param string $get_user_id
 * @param string $eudfield
 * @param string $value
 * @return void
 * @author Vadimk
 */
function eud_delete_option( $get_user_id, $eudfield, $value){
    if( function_exists( 'delete_user_meta' ) ) {
        delete_user_meta( $get_user_id, str_replace( 'eud', '', $eudfield ), $value );
    }
    else {
        delete_usermeta( $get_user_id, str_replace( 'eud', '', $eudfield ), $value );
    }
}

/**
 * Return current editing user_id
 *
 * @return int
 * @author Vadimk
 */
function get_user_id() {

    $get_user_id = empty( $_GET['user_id'] ) ? null : $_GET['user_id'];

    if ( ! isset( $get_user_id ) ) {
        $get_user_id = empty( $_POST['user_id'] ) ? null : $_POST['user_id'];
    }

    if ( ! isset( $get_user_id ) ) {
        global $current_user;
        get_currentuserinfo();
        $get_user_id = $current_user->ID;
    }

    return $get_user_id;
}


/* Wrapper for esc_attr for backward compatibility */
if ( ! function_exists( 'esc_attr' ) ) {
    function esc_attr( $text ) {
        return attribute_escape( $text );
    }
}

/* Wrapper for esc_html for backward compatibility */
if ( ! function_exists( 'esc_html' ) ) {
    function esc_html( $text ) {
        return wp_specialchars( $text );
    }
}

/* Wrapper for get_user_meta for backward compatibility */
if ( ! function_exists( 'get_user_meta' ) ) {
    function get_user_meta( $userid, $metakey, $single ) {
        return get_usermeta( $userid, $metakey );
    }
}
