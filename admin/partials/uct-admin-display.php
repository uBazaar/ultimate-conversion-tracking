<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.ubazaar.co
 * @since      1.0.0
 *
 * @package    Ultimate_Conversion_Tracking
 * @subpackage Ultimate_Conversion_Tracking/admin/partials
 */
?>

<?php
global $wpdb;
?>

<div id="uct-settings-notice" class=''>

</div>

<h1>
  <div id="uct-admin-settings-form container">
<?php
/**
*
* LinkedIn
*
**/
?>

<?php
$query = "
    SELECT value
    FROM wp_uct_admin_settings
    WHERE property = 'uct-linkedin-insight-tag'
    OR property = 'uct-google-tracking-id'
    OR property = 'uct-facebook-pixel-id'
    OR property = 'uct-twitter-pixel-id'
 ";

$values = $wpdb->get_results($query, OBJECT);

$settings = array();

foreach($values as $key=>$value){
    $settings[$key] = $value;
}

?>

<div class="form-group row">
  <div "col-xs-12 col-md-4"><label for="uct-linkedin-insight-tag">LinkedIn Insight Tag</label></div>
  <div "col-xs-12 col-md-8"><input type="text" id="uct-linkedin-insight-tag" value="<?php echo $settings["uct-linkedin-insight-tag"] ?>"></div>
</div>

<?php
/**
*
* Google
*
**/
?>

<div class="form-group row">
  <div "col-xs-12 col-md-4"><label for="uct-google-tracking-id">Google Analytics Tracking ID</label></div>
  <div "col-xs-12 col-md-8"><input type="text" id="uct-google-tracking-id" value="<?php echo $settings["uct-google-tracking-id"] ?>"></div>
</div>

<?php
/**
*
* Facebook
*
**/
?>

<div class="form-group row">
  <div "col-xs-12 col-md-4"><label for="uct-facebook-pixel-id">Facebook Pixel ID</label></div>
  <div "col-xs-12 col-md-8"><input type="text" id="uct-facebook-pixel-id" value="<?php echo $settings["uct-facebook-pixel-id"] ?>"></div>
</div>

<?php
/**
*
* Twitter
*
**/
?>

<!--<div class="form-group row">
  <div "col-xs-12 col-md-4"><label for="uct-twitter-pixel-id">Twitter Pixel ID</label></div>
  <div "col-xs-12 col-md-8"><input type="text" id="uct-twitter-pixel-id" value="<?php echo $settings["uct-twitter-pixel-id"] ?>" readonly></div>
</div>-->

</div>

<?php
/**
*
* Save
*
**/
?>

<button type="button" class="btn btn-success" id="uct-save-admin-settings">Save Settings</button>
