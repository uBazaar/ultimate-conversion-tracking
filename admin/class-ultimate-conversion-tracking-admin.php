<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.ubazaar.co
 * @since      1.0.0
 *
 * @package    Ultimate_Conversion_Tracking
 * @subpackage Ultimate_Conversion_Tracking/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ultimate_Conversion_Tracking
 * @subpackage Ultimate_Conversion_Tracking/admin
 * @author     uBazaar Limited <ask@ubazaar.co>
 */
class Ultimate_Conversion_Tracking_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Tracking types.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array   $version    Tracking type keys.
	 */
	public $tracking_types;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->tracking_types = array();
		array_push($this->tracking_types,"uct-linkedin-insight-tag");
		array_push($this->tracking_types,"uct-google-tracking-id");
		array_push($this->tracking_types,"uct-facebook-pixel-id");
		array_push($this->tracking_types,"uct-twitter-pixel-id");

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ultimate_Conversion_Tracking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ultimate_Conversion_Tracking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ultimate-conversion-tracking-admin.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name."-bootstrap", plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ultimate_Conversion_Tracking_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ultimate_Conversion_Tracking_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ultimate-conversion-tracking-admin.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name."-popper", plugin_dir_url( __FILE__ ) . 'js/popper.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name."-bootstrap", plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( $this->plugin_name, 'settings', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	}

	public function uct_add_admin_menu() {

		add_menu_page(
			'Conversion Tracking',
			'Conversion Tracking',
			'manage_options',
			$this->plugin_name,
			array(
				$this,
				'uct_admin_display'
			),
			'dashicons-welcome-write-blog',
			5
		);

	}

	public function uct_admin_display() {
		include_once( 'partials/uct-admin-display.php' );
	}

	public function uct_ajax_save_admin_settings(){

		global $wpdb;

		$data = $_POST;

		foreach ($data as $key => $value) {
			foreach ($this->tracking_types as $k => $type) {
				if($key == $type){
					$results = $wpdb->get_results( "
						SELECT id
						FROM $wpdb->prefix.uct_admin_settings
						WHERE property = '$key'
					");
					$id = null;
					$sql = "";
					foreach ($results as $rkey => $result) {
						$id = $result->id;
					}
					if($id == null){
						$wpdb->insert($wpdb->prefix.'uct_admin_settings',
							array('property'=>$key,'value'=>$value),
							array('%s','%s'));
					}
					else{
						$wpdb->update( 'wp_dotsign_admin_settings',
		        array('property'=>$key,'value'=>$value),
		        array( 'id' => $id ), array('%s','%s'), array( '%d' ) );
					}
				}
			}
		}
		wp_send_json_success( array("message"=>"Saved Settings") );
		exit();
	}

	public function uct_admin_database_configuration(){
		global $wpdb;

	 $charset_collate = $wpdb->get_charset_collate();

	 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	 $table_name = $wpdb->prefix."uct_admin_settings";

	 $sql = "CREATE TABLE $table_name (
	 id mediumint(9) NOT NULL AUTO_INCREMENT,
	 property varchar(50) DEFAULT '' NOT NULL UNIQUE,
	 value varchar(255) DEFAULT '' NOT NULL,
	 PRIMARY KEY  (id)
	 ) $charset_collate;";

	 dbDelta( $sql );

	 $table_name = $wpdb->prefix."uct_log";

	 $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		created_at datetime NOT NULL,
		property varchar(50) DEFAULT '' NOT NULL UNIQUE,
		value varchar(255) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
		) $charset_collate;";

		//current_time( 'mysql' )

		dbDelta( $sql );

	}

}
