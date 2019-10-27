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
  <div id="uct-admin-settings-form">
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

<div class="form-group">
  <label for="uct-linkedin-insight-tag">LinkedIn Insight Tag</label>
  <input type="text" id="uct-linkedin-insight-tag" value="<?php echo $settings["uct-linkedin-insight-tag"] ?>">
</div>

<?php
/**
*
* Google
*
**/
?>

<div class="form-group">
  <label for="uct-google-tracking-id">Google Analytics Tracking ID</label>
  <input type="text" id="uct-google-tracking-id" value="<?php echo $settings["uct-google-tracking-id"] ?>">
</div>

<?php
/**
*
* Facebook
*
**/
?>

<div class="form-group">
  <label for="uct-facebook-pixel-id">Facebook Pixel ID</label>
  <input type="text" id="uct-facebook-pixel-id" value="<?php echo $settings["uct-facebook-pixel-id"] ?>">
</div>

<?php
/**
*
* Twitter
*
**/
?>

<div class="form-group">
  <label for="uct-twitter-pixel-id">Twitter Pixel ID</label>
  <textarea id="uct-twitter-pixel-id" rows="4" cols="50"><?php echo $settings["uct-twitter-pixel-id"] ?></textarea>
</div>

<?php
/**
*
* Save
*
**/
?>

<button type="button" class="btn btn-success" id="uct-save-admin-settings">Save Settings</button>
