<?php
  namespace Application;
  
  class Estr {
    
    public static function __callStatic ( $name, $arguments ) {
      $class_vars = get_class_vars ( get_called_class ( ) );
      if ( is_array ( $class_vars ) && sizeof ( $class_vars ) > 0 ) {
        foreach ( $class_vars as $key => $value ) {
          if ( strcasecmp ( $key, $name ) == 0 ) {
            return str_replace ( '_', '-', $key );
          }
        }
      }
      trigger_error ( get_called_class ( ) . "->$$name undefined", E_USER_ERROR );
    }
    
  }