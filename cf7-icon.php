<?php
/*
Plugin Name: CF7 Submit Button with FontAwesome
Plugin URI: http://ank91.github.io
Description: Add an FontAwesome icon submit button to the popular Contact Form 7 plugin.
Author: ank91
Author URI: http://ank91.github.io
Version: 1.0
*/
if(file_exists(WP_PLUGIN_DIR.'/contact-form-7/wp-contact-form-7.php'))
{
    //means cf7 is installed
add_action('wpcf7_init', 'wpcf7_add_shortcode_icon_btn');
function wpcf7_add_shortcode_icon_btn()
{
    if (!function_exists('wpcf7_add_shortcode')) return;
    wpcf7_add_shortcode('button', 'wpcf7_icon_btn_shortcode_handler');
}
function wpcf7_icon_btn_shortcode_handler($tag)
{
    $tag = new WPCF7_Shortcode($tag);
    $class = wpcf7_form_controls_class($tag->type);
    $atts = array();
    $atts['class'] = $tag->get_class_option($class);
    $atts['class']=$atts['class'].' wpcf7-submit'; //add the default submit class
    $atts['id'] = $tag->get_id_option();
    $atts['tabindex'] = $tag->get_option('tabindex', 'int', true);
    $atts['type'] = 'submit';
    $atts = wpcf7_format_atts( $atts );
    //get icon class
    $icon_class = $tag->get_option('icon', '',true);
    $icon_class=empty($icon_class)?'fa-send':$icon_class; //add default class if empty
    $icon_class='fa '.esc_attr($icon_class); //add fa // did u notice space after fa
    //get button label
    $value = isset($tag->values[0]) ? $tag->values[0] : '';
    if (empty($value)) $value = __('Send', 'contact-form-7');
    //complete string
    $html = sprintf( '<button %1$s /><i class="%2$s"></i> %3$s</button>', $atts,$icon_class,esc_html($value) );
    return $html;
}
/* Tag generator */
add_action('admin_init', 'wpcf7_add_tag_generator_icon_btn', 56);
function wpcf7_add_tag_generator_icon_btn()
{
    if (!function_exists('wpcf7_add_tag_generator'))
        return;
    wpcf7_add_tag_generator('icon_btn', 'Submit Button with Icon',
        'wpcf7-tg-pane-icon_btn', 'wpcf7_tg_pane_icon_btn', array('nameless' => 1));
}
function wpcf7_tg_pane_icon_btn($contact_form)
{
    ?>
<div id="wpcf7-tg-pane-icon_btn" class="hidden">
        <form action="">
            <table>
                <tr>
                    <td><code>Button id</code> (<?php echo esc_html(__('optional', 'contact-form-7')); ?>)<br/>
                        <input type="text" name="id" class="idvalue oneline option"/></td>

                    <td><code>Button class</code> (<?php echo esc_html(__('optional', 'contact-form-7')); ?>)<br/>
                        <input type="text" name="class" class="classvalue oneline option"/></td>
                </tr>
                <tr>
                    <td><?php echo esc_html(__('Label', 'contact-form-7')); ?>
                        (<?php echo esc_html(__('optional', 'contact-form-7')); ?>)<br/>
                        <input type="text" name="values" class="oneline"/> </td>
                    <td><code>Font-awesome icon class</code><br/>
                        <input placeholder="fa-send" type="text" name="icon" class="classvalue oneline option"/></td>

                </tr>
            </table>
            <div class="tg-tag"><?php echo esc_html(__("Copy this code and paste it into the form left.", 'contact-form-7')); ?> <br/>
                <input type="text" name="button" class="tag wp-ui-text-highlight code" readonly="readonly" onfocus="this.select()"/></div>
            <label>While typing icon class do not include <code>fa</code>, see placeholder for example</label>
        </form>
</div>
<?php
}
}//if cf7 is installed
?>