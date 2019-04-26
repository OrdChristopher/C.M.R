<?php
  namespace application;
  
  class PrePostMethodObjectStack {
    
    private $premethod = null;
    
    public function __call ( $name, $arguments ) {
      
      echo "__call";
      
      if ( method_exists ( $this, $name ) && is_callable ( array ( $this, $name ) ) ) {
        
        if ( ( $result = call_user_func_array ( array ( $this, $name ), $arguments ) ) == $this ) {
          
          return $result;
          
        } elseif ( $result === false ) {
          
          return false;
          
        } else {
          
          throw new Exception ( $result );
          
        }
        
      }
      return $this;
      
    }
  
  }
  
  class Calls extends PrePostMethodObjectStack {
    
    public function test ( ) {
      
      echo "test";
      
    }
    
  }
  
  $calls = new Calls ( );
  var_dump ( $calls->test ( ) );