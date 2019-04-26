<?php
  namespace application\view;
  
  class view {
    
    public $control;
    public $model;
    public $html;
    
    public function __construct ( $control, $model ) {
      
      $this->control = $control;
      $this->model = $model;
      $this->html = new \application\html ( );
      $class_call = ( $class_name = explode ( '\\', get_class ( $this ) ) ) [ sizeof ( $class_name ) - 1 ];
      $this->$class_call ( );
      
    }
    
  }