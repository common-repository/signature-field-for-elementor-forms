<?php
/**
 * Plugin Name: Signature field for Elementor Forms
 * Description: Elementor Form Signature addon makes it easy for users to sign your forms.
 * Plugin URI: https://add-ons.org/plugin/gravity-forms-repeater-fields/
 * Version: 1.3.5
 * Author: add-ons.org
 * Requires Plugins: elementor
 * Text Domain: signature-field-for-elementor-forms
 * Domain Path: /languages
 * Author URI: https://add-ons.org/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
**/
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if (!defined('SUPERADDONS_ELEMENTOR_SIGNATURE_PLUGIN_PATH')) {
    define( 'SUPERADDONS_ELEMENTOR_SIGNATURE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
    define( 'SUPERADDONS_ELEMENTOR_SIGNATURE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    add_action( 'elementor_pro/forms/fields/register', 'superaddons_elementor_add_new_signature_field' );
    function superaddons_elementor_add_new_signature_field($form_fields_registrar){
        require_once( SUPERADDONS_ELEMENTOR_SIGNATURE_PLUGIN_PATH."fields/signature.php" );
        $form_fields_registrar->register( new \Superaddons_Elementor_Signature_Field() );
    }
    include SUPERADDONS_ELEMENTOR_SIGNATURE_PLUGIN_PATH."superaddons/check_purchase_code.php";
    new Superaddons_Check_Purchase_Code( 
        array(
            "plugin" => "signature-field-for-elementor-forms/signature-field-for-elementor-forms.php",
            "id"=>"1527",
            "pro"=>"https://add-ons.org/plugin/elementor-forms-signature-fields/",
            "plugin_name"=> "Signature field for Elementor Forms",
            "document"=>"https://add-ons.org/document-elementor-forms-signature/"
        )
    );
    if(!class_exists('Superaddons_List_Addons')) {  
        include SUPERADDONS_ELEMENTOR_SIGNATURE_PLUGIN_PATH."add-ons.php"; 
    }
}