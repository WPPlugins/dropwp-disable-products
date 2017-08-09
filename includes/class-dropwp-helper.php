<?php

namespace Dropwp_DisableProducts;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Dropwp Helper
 *
 * @since      1.0.0
 * @package    Dropwp
 * @author     Jato <roberto.gonzalez@dropwp.com>
 */
 class Dropwp_Helper {

     static protected $url = 'http://publi.informax.es/';
     static protected $timeout_seconds = 15;

     public static function get_image_list( $type ) {
         $image_list = get_transient( 'dropwp_publi_images_' . $type );
         if ( ( false === $image_list ) || ( !is_array( $image_list )) ) {
             $response = wp_remote_get( Dropwp_Helper::$url . $type . '.txt' );
             if ( is_array($response) ) {
                 $cvs_list = $response['body'];
                 $cvs_list = explode("\n", $cvs_list);
                 $image_list = array();
                 foreach ( $cvs_list as $key => $value ) {
                     $image = explode( ';', $value );
                     $image_list[ $image[1] ] = array(
                         'image' => Dropwp_Helper::$url . 'img/' . $image[0],
                         'href' => $image[2],
                     );
                 }
                 if ( sizeof($image_list) > 0 ) {
                     set_transient( 'dropwp_publi_images_' . $type, $image_list, 24 * HOUR_IN_SECONDS );
                 }
             }
         }

         return $image_list;
     }

     public static function get_image_html( $image_list, $image_name ) {
         $html = '';
         if ( array_key_exists( $image_name, $image_list ) ) {
             $html = '<a href="' . $image_list[$image_name]['href'] . '" >';
             $html .= '<img src="' . $image_list[$image_name]['image'] . '" ></a>';
         } else {
             $html = '';
         }

         return $html;
     }

 }
