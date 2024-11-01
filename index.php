<?php
/**
 * Tabdil APP
 * @package           TabdilApp Persian Weight Converter
 * @author            Jafar Naghizadeh
 * @copyright         2023 Tabdil.app
 * @license           GPL-2.0-or-later
 * @wordpress-plugin
 * Plugin Name:       Tabdil.App Persian Weight Converter
 * Plugin URI:        https://tabdil.app
 * Description:       Developed by Jafar Naghizadeh with 💜 for wordpress ;) 2023.
 * Version:           1.3
 * Requires at least: 4.7
 * Requires PHP:      7.2
 * Author:            Jafar Naghizadeh
 * Author URI:        https://tabdil.app
 * Text Domain:       tabdilApps
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

$modules_jafar = [
    'conversion' => [
        'persianWeight'=> ['all', 'css','js'],
    ]
];

if (!function_exists('tabdil_app_jafar_shortcode_fnc')) {
    function tabdil_app_jafar_shortcode_fnc( $atts = [], $content = null, $tag = '' ){
        return tabdil_app_jafar_go_to_this_module( $atts );
    }
    add_shortcode('tabdil','tabdil_app_jafar_shortcode_fnc');
}

if (!function_exists('tabdil_app_jafar_find_module')) {
    function tabdil_app_jafar_find_module( $title ){
        global $modules_jafar;
        foreach( $modules_jafar as $sec=>$v ){
            @$module = $v[ $title ];
            if( isset( $module ) ){
                $module['index'] = array_search( $title, array_keys($v) ); //used in conversion > functions > rdata
                $module[] = $sec;
                return $module;
            }
        }
        return false;
    }
}

if (!function_exists('tabdil_app_jafar_go_to_this_module')) {
    function tabdil_app_jafar_go_to_this_module( $atts ){
        $module = tabdil_app_jafar_find_module( $atts[0] );
        if( !$module ) return "plugin error: 28";
        $type_name = $module[0];
        $section = end($module);
        $version = '1.2'; // for css and js cache

        if( $module[1] )
            wp_enqueue_style(
                "css_for_{$section}_{$type_name}",
                //plugins_url( "/css/{$type_name}.css", __FILE__ ), 
                plugins_url( "/css/main.css?$version", __FILE__ ),  
            );
        if( $module[2] )
            wp_enqueue_script(
                "ajax_script_for_{$section}_{$type_name}",
                plugins_url( "/{$section}/js/{$type_name}.js", __FILE__ ),
                array( 'jquery' ), $version, true
            );

        $inc = dirname(__FILE__) . "/{$section}/{$type_name}.php";
        if( is_file( $inc ) ){
            //ob_start();
            include_once $inc;
            //$ret = ob_get_contents(); 
            //ob_end_clean();
        }else
            return "Plugin file not found: error 27";
    }
}

global $tabdilapp_db_version;
$tabdilapp_db_version = '1.0';

if (!function_exists('tabdil_app_jafar_install')) {
    function tabdil_app_jafar_install() {
        global $tabdilapp_db_version;
        add_option( 'tabdil_app_jafar_db_version', $tabdilapp_db_version );
    }
    register_activation_hook( __FILE__, 'tabdil_app_jafar_install' );
}

if (!function_exists('tabdil_app_jafar_Deactivate')) {
    function tabdil_app_jafar_Deactivate() {
        delete_option( 'tabdil_app_jafar_db_version' );
    }
    register_deactivation_hook( __FILE__, 'tabdil_app_jafar_Deactivate' );
}

