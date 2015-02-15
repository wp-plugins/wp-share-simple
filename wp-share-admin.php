<?php
/**
 * WP share simple Admin Options File
 */

function wp_share_simple_admin_page() {
add_options_page('WP Share Simple', 'WP Share Simple', 'manage_options', 'wp_share_simple', 'wp_share_simple_options_page');
}
add_action('admin_menu', 'wp_share_simple_admin_page');

function wp_share_simple_options_page () {
    ?>
    <div class="wrap">
     <form action="options.php" method="post">
               <?php settings_fields('wp_share_simple_options'); ?>
               <?php do_settings_sections('wp_share_simple'); ?>
         <input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
     </form>
    </div>
    <?php
}

function wp_share_simple_admin_init(){
//register setting
register_setting( 'wp_share_simple_options', 'wp_share_simple_options');
// Add section
add_settings_section('wp_share_simple_main', 'Wp Share Simple Settings', 'wp_share_simple_dummy_text', 'wp_share_simple');
// Add field to it
add_settings_field('wp_share_simple_button_option', 'Buttons Display option', 'wp_share_simple_button_option', 'wp_share_simple', 'wp_share_simple_main');
// Share count Color
add_settings_field('wp_share_simple_count_color', 'Share Count Color', 'wp_share_simple_count_color', 'wp_share_simple', 'wp_share_simple_main');
}

add_action('admin_init', 'wp_share_simple_admin_init');

function wp_share_simple_dummy_text() {
  echo '';
}

function wp_share_simple_count_color() {
    $options = get_option('wp_share_simple_options');
    $val =  $options != null ? $options['count_color'] : '#999';

    if($val == null || $val=='')
    {
        $val = '#999';
    }

    echo "<input type='text' id='wp_share_simple_count_color' name='wp_share_simple_options[count_color]' value='$val'/>";

}

// one of the plugin field.
function wp_share_simple_button_option () {
    $options = get_option('wp_share_simple_options');
    $val =  $options != null ? $options['display_option'] : 'both';
    if($val == null or $val =='')
    {
        // Default display
        $val = 'both';
    }
    // Manual option for next release
    //$optionManual = $val =='manual' ? " <option value = 'manual' checked>Manual</option>":" <option value = 'manual'>Manual</option>";

    $optionTop    = $val == 'top' ? "<option value = 'top' selected>Top Only</option>":"  <option value = 'top'>Top Only</option>";
    $optionBottom = $val == 'bottom' ? "<option value = 'bottom' selected> Bottom Only</option>" :"<option value = 'bottom'> Bottom Only</option>";
    $optionBoth   = $val == 'both' ? "<option value = 'both' selected>Top & Bottom </option>":"<option value = 'both'>Top & Bottom </option>";

    echo "<select id = 'wp_share_simple_button_option' name='wp_share_simple_options[display_option]'>";
    echo $optionTop.$optionBottom.$optionBoth;
    echo "</select>";
}
?>