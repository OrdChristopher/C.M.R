<?php
  namespace application\control;
  
  class control  {
    
    public $model;
    
    public function __construct ( $model ) {
      
      $this->model = $model;
      
    }
    
  }