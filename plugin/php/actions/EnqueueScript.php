<?php

namespace plugin\php\actions;

use plugin\php\interfaces\Action;

class EnqueueScript implements Action {

    protected $scripts;
     
    public function __construct($scripts)
     {
         $this->scripts = $scripts;

     }

     private function add_scripts()
     {
         foreach($this->scripts as $script)
         {
            extract($script,EXTR_OVERWRITE);
            wp_enqueue_script($name,$path_uri,$deps,$version,$args);
         }
     }

     #[\Override] 
     public function run(): void
     {
        add_action('wp_enqueue_scripts', $this->add_scripts(...));
     }



}