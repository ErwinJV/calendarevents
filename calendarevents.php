<?php

/**
 * Plugin Name: Calendar events
 * Description: Manage events posts and display them on calendar shortcode
 * Version:1.0
 * Author: Erwin Jimenez
 */

use plugin\php\actions\EnqueueScript;
use plugin\php\actions\RegisterPostType;
use plugin\php\Plugin;

$dir_path = WP_PLUGIN_DIR .'/calendarevents';
$dir_shortcodes = $dir_path . '/plugin/php/shortcodes';


define('PLUGIN_PATH',$dir_path);
define('PLUGIN_SITE_NAME',get_bloginfo('name'));

require_once PLUGIN_PATH . '/plugin/php/shortcodes/calendar_posts_shortcode.php';
require_once PLUGIN_PATH . '/plugin/php/metaboxes/calendar_metaboxes.php';

 spl_autoload_register(function (string $className) {
   $path = str_replace('\\', '/', $className);
   $classPath = PLUGIN_PATH . "/$path" . ".php";
   if (file_exists($classPath)) {
       require $classPath;
   }
});


// Enqueue JS scripts
$enqueue_scripts = new EnqueueScript([
   [
      'name' => 'bundle-wushu-js',
      'path_uri' => plugins_url('dist/bundle.js',__FILE__),
      'deps' => [],
      'version' => '1.0',
      'args' => ['strategy'=>'defer'],
   ],
]);
$enqueue_scripts->run();

$register_cpt = new RegisterPostType([
   'event'=>[
      "plural"=>"events",
      "icon"=>"dashicons-clock"
   ],
]);
$register_cpt->run();

// $taxonomy = new PluginRegisterTaxonomy([
//    'events'=>[
//       'object_type'=>['posts'],
//       'args'=>[
//           'hierarchical'=>true,
//           'show_ui'=>true,
//           'show_admin_column'=>true,
//           'query_var'=>true,
//           'rewrite'=>array('slug'=>'events'),
//           'show_in_rest'=>true,
//           'rest_base'=> 'events',
//           'rest_controller_class'=>'WP_REST_Terms_Controller',   
//       ]
//    ],
// ]);

$plugin = new Plugin();

register_activation_hook(__FILE__,[$plugin,'plugin_activation']);
register_deactivation_hook(__FILE__,[$plugin,'plugin_deactivation']);
