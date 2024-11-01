<?php
//error_reporting(E_ERROR);
// if( end($atts) == 'title' ) {
//     echo esc_html( 'Convert units of '.$atts[0] ); return;
// }else{

    if( !$_POST ){

        require_once __DIR__ ."/functions.php";
        TabdilApp\tabdil_app_jafar_makeForm( $atts, $module );
        TabdilApp\tabdil_app_jafar_get_res( $atts );

    }
