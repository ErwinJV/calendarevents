<?php 

namespace plugin\php\actions;

use plugin\php\interfaces\Action;

class EnqueueStyle implements Action {

    protected $styles;
     
    public function __construct($styles)
    {
        $this->styles = $styles;

       
    }
 

   private function add_styles()
    {
        foreach($this->styles as $style){
             
            extract($style,EXTR_OVERWRITE);
            
            wp_enqueue_style($name,$path_uri,$deps,$version,$media);
        }
    }

    #[\Override]
    public function run():void
    {
        add_action('wp_enqueue_scripts',$this->add_styles(...));
    }

}