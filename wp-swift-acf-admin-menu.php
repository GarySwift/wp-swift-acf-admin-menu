<?php
/**
 * @link              https://github.com/GarySwift
 * @since             1.0.0
 * @package           WP_Swift_ACF_Admin_Menu
 *
 * @wordpress-plugin
 * Plugin Name:       WP Swift: ACF Admin Menu
 * Plugin URI:        https://github.com/GarySwift/wp-swift-google-map
 * Description:       Adds an advanced custom field menu and subpages to the wordpress admin area
 * Version:           1.0.0
 * Author:            Gary
 * Author URI:        https://github.com/GarySwift
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-swift-acf-admin-menu
 * Domain Path:       /languages
 */

class WP_Swift_ACF_Admin_Menu {
	private $parent = 'custom_settings';
    /*
     * Initializes the plugin.
     */
    public function __construct() {
    	add_action( 'admin_menu', array($this, 'show_menu') );


    }

    public function google_api_key_page() {
		include('google-api-key.php');  	
    }
    public function show_menu() {



    	# Choose what sidebar fields to show - these are ACF input fields that can be used globally
$show_sidebar_options=true;
$show_sidebar_option_contact_details=true;
$show_sidebar_option_social_media=false;
$show_sidebar_option_company_details=false;
$show_sidebar_option_contact_numbers=false;
$show_sidebar_options_opening_hours=false;
$show_sidebar_option_location=false;
$show_sidebar_option_global_contact_form=false;

$show_google_api_key=true;

/** Adds menu items to backend sidebar */
# ref: https://www.advancedcustomfields.com/add-ons/options-page/
if(function_exists('acf_add_options_page')) { 
    $user = wp_get_current_user();
    if (user_can( $user->ID, 'administrator' ) || user_can( $user->ID, 'editor' )) { // Editor and below
        if($show_sidebar_options) {
            acf_add_options_page(array(
                'page_title'    => 'BrightLight ACF',
                'menu_slug'     => $this->parent,
                'icon_url'      => plugins_url( 'favicon-16x16.png', __FILE__ ),
                'capability'    => 'manage_options',
                // 'position' => 2,
            )); 

            if($show_sidebar_option_social_media) {
                acf_add_options_sub_page(array(
                    'title' => 'Social Media',
                    'slug' => 'social_media',
                    'parent' => $this->parent,
                ));
            }
            if($show_sidebar_option_contact_details) {
                acf_add_options_sub_page(array(
                    'title' => 'Contact Details',
                    'slug' => 'contact_details',
                    'parent' => $this->parent,
                ));        
            }
            if($show_sidebar_option_company_details) {
                acf_add_options_sub_page(array(
                    'title' => 'Company Details',
                    'slug' => 'company_details',
                    'parent' => $this->parent,
                )); 
            }
            if($show_sidebar_option_contact_numbers) {
                acf_add_options_sub_page(array(
                    'title' => 'Contact Numbers',
                    'slug' => 'contact_numbers',
                    'parent' => $this->parent,
                )); 
            }   
            if($show_sidebar_options_opening_hours) {
                acf_add_options_sub_page(array(
                    'title' => 'Opening Hours',
                    'slug' => 'opening-hours',
                    'parent' => $this->parent,
                )); 
            }  
            if($show_sidebar_option_location) {   
                acf_add_options_sub_page(array(
                    'title' => 'Location',
                    'slug' => 'location',
                    'parent' => $this->parent,
                )); 
            }
            if($show_sidebar_option_global_contact_form) {   
                acf_add_options_sub_page(array(
                    'title' => 'Service Form Fields',
                    'slug' => 'form-fields',
                    'parent' => $this->parent,
                )); 
            }  
            acf_add_options_sub_page(array(
                'title' => 'Sign Up Form',
                'slug' => 'sign-up-form',
                'parent' => $this->parent,
            ));   

            acf_add_options_sub_page(array(
                'title' => 'Header Banner',
                'slug' => 'header-banner',
                'parent' => 'wp-swift-brightlight-main-menu',//$this->parent,
            ));
            if ($show_google_api_key) {
             	$this->google_api_key_page();
            } 
            

        }        
    }   
}

// if(function_exists('acf_add_options_page')) { 
//     $user = wp_get_current_user();
//     if (user_can( $user->ID, 'administrator' ) || user_can( $user->ID, 'editor' )) { // Editor and below
//         acf_add_options_page(array(
//             'page_title'    => 'Home Page Parts',
//             'menu_slug'     => 'home_page_parts',
//             'icon_url'      => 'dashicons-admin-home',
//             'capability'    => 'manage_options',
//             // 'position' => 2,
//         )); 
//         acf_add_options_sub_page(array(
//             'title' => 'Top Banner',
//             'slug' => 'top_banner',
//             'parent' => 'home_page_parts',
//         ));
//         acf_add_options_sub_page(array(
//             'title' => 'Search Info',
//             'slug' => 'search_info',
//             'parent' => 'home_page_parts',
//         ));                                 
//     }   
// }
    }
}
$wp_swift_acf_admin_menu = new WP_Swift_ACF_Admin_Menu();