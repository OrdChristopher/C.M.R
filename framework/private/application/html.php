<?php
  namespace application;
  
  class html {
    
    protected $xmlWriter = null;
    private $nest = null;
    
    public function __construct ( $indent = true ) {
      
      $this->xmlWriter = new \XmlWriter ( );
      $this->xmlWriter->openMemory ( );
      $this->xmlWriter->setIndent ( $indent );
      $this->xmlWriter->writeDtd ( 'html' ); 
      $this->nest = array (
        array ( ),
        array ( )
      );
      
    }
    
    public function __call ( $name, $arguments ) {
      
      $nest = array (
        "tag" => $name,
        "value" => array ( )
      );
      foreach ( $arguments as $key => $egg ) {
        
        if ( is_array ( $egg ) ) {
          
          $nest [ 'value' ] [ ] = $egg;
          
        } elseif ( is_object ( $egg ) ||  is_string ( $egg ) ) {
         
          $nest [ 'value' ] [ ] = $egg;
         
        }
       
      }
      return ( $this->nest = $nest );
      
    }
    
    public function __destruct ( ) {
      
      array_walk (
        $this->nest,
        array (
          $this,
          'nestle'
        )
      );
      echo $this->xmlWriter->outputMemory ( );
      $this->xmlWriter = null;
      
    }
    
    public function nestle ( $array, $text ) {
      
      if ( is_array ( $array ) ) {
        
        foreach ( $array as $key => $value ) {
          
          if ( is_array ( $value ) ) {
            
            for ( $index = 0, $sizeof = sizeof ( $value [ 'value' ] ); $index < $sizeof; $index++ ) {
              
              if ( isset ( $value [ 'value' ] [ $index ] ) && is_string ( $value [ 'value' ] [ $index ] ) ) {
              
                array_push ( $value [ 'value' ], $value [ 'value' ] [ $index ] );
                unset ( $value [ 'value' ] [ $index ] );
                
              }
              
            }
            
            $value = array_values ( $value );
            
            array_walk (
              $value,
              array (
                $this,
                'nestle'
              )
            );
            
          } elseif ( is_string ( $value ) ) {
            
            $this->xmlWriter->writeRaw ( $value );
            
          } elseif ( is_object ( $value ) ) {
            
            if ( !empty ( $value->callback ( ) ) ) {
              
              $reflectionMethod = new \ReflectionMethod ( 
                'XmlWriter',
                $value->callback ( )
              );
              $callbackParameters = $reflectionMethod->getParameters ( );
              $callbackVariables = get_object_vars ( $value );
              
              if ( sizeof ( $callbackParameters ) == sizeof ( $callbackVariables ) ) {
                
                call_user_func_array (
                  array (
                    $this->xmlWriter,
                    $value->callback ( )
                  ),
                  $callbackVariables
                );
                
              }
              
            }
            
          }
          
        }
        
        $this->xmlWriter->endElement ( );
        
      } else {
        
        $this->xmlWriter->startElement ( $array );
        
      }
      
    }
    
    private function node ( $callback, ...$parameters ) {
      
      return new class ( $callback, $parameters ) {
        
        private $callback = null;
        
        public function __construct ( $callback, $parameters ) {
          
          $this->callback = $callback;
          $reflectionMethod = new \ReflectionMethod ( 'XmlWriter', $this->callback );
          $callbackParameters = $reflectionMethod->getParameters ( );
          
          if ( sizeof ( $callbackParameters ) == sizeof ( $parameters ) ) {
            
            foreach ( $callbackParameters as $key => $value ) {
              
              $this->{ $value->name } = $parameters [ $key ];
              
            }
            
          }
          
        }
        
        public function __call ( $name, $arguments ) {
          
          if ( isset ( $this->$name ) ) {
            
            return $this->$name;
            
          }
          
          return null;
          
        }
        
      };
      
    }
    
    public function attribute ( $name, $value = '' ) {
      
      return $this->node ( 'writeAttribute', $name, $value );
      
    }
    
    public function stylesheets ( ...$parameters ) {
      
      $imports = "";
      foreach ( $parameters as $key => $value ) {
        
        $imports .= "@import url(\"{$value}\");";
        
      }
      
      if ( !empty ( $imports ) ) {
        
        return $this->style (
          $this->attribute ( 'type', 'text/css' ),
          $imports
        );
      
      }
      
      return false;
      
    }
    
  }