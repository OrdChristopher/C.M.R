<?php
  
  namespace application;
  
  class html5 {
    
    protected $xmlWriter = null;
    private $tags = null;
    
    public function __construct ( $version = '1.0', $encoding = 'utf-8', $indent = true ) {
      
      $this->xmlWriter = new \XmlWriter ( );
      $this->xmlWriter->openMemory ( );
      $this->xmlWriter->setIndent ( $indent );
      $this->xmlWriter->writeDtd ( 'html' ); 
      $this->tags = array ( );
      
    }
    
    public function __call ( $name, $arguments ) {
      
      $tags = array ( $name => array ( ) );
      
      foreach ( $arguments as $tag => $node ) {
        
        if ( is_array ( $node ) ) {
          
          $tags [ $name ] = array_merge ( $tags [ $name ], $node );
          
        } elseif ( is_object ( $node ) ) {
          
          array_push ( $tags [ $name ], $node );
          
        } elseif ( is_string ( $node ) ) {
         
          array_push ( $tags [ $name ], $node );
         
        }
       
      }
      
      return ( $this->tags = $tags );
      
    }
    
    public function parseTags ( $node, $tag ) {
      
      if ( is_string ( $tag ) ) {
        
        $this->xmlWriter->startElement ( $tag );
          
          if ( is_array ( $node ) ) {
            
            if ( !empty ( $node ) ) {
              
              if ( array_keys ( $node ) === range ( 0, count ( $node ) - 1 ) ) {
                
                for ( $index = 0, $sizeof = sizeof ( $node ); $index < $sizeof; $index++ ) {
                  
                  if ( is_string ( $node [ $index ] ) ) {
                    
                    echo "lol";
                    array_push ( $node, $node [ $index ] );
                    unset ( $node [ $index ] );
                    
                  }
                  
                }
                
                $node = array_values ( $node );
                
              }
              
              array_walk (
                $node,
                array (
                  $this,
                  'parseTags'
                )
              );
              
            }
            
            $this->xmlWriter->endElement ( );
            
          }
        
      } elseif ( is_numeric ( $tag ) ) {
        
        if ( is_string ( $node ) ) {
          
          $this->xmlWriter->writeRaw ( $node );
         
        } else if ( is_object ( $node ) ) {
          
          if ( !empty ( $node->callback ( ) ) ) {
            
            $reflectionMethod = new \ReflectionMethod ( 
              'XmlWriter',
              $node->callback ( )
            );
            $callbackParameters = $reflectionMethod->getParameters ( );
            $callbackVariables = get_object_vars ( $node );
            
            if ( sizeof ( $callbackParameters ) == sizeof ( $callbackVariables ) ) {
              
              call_user_func_array (
                array (
                  $this->xmlWriter,
                  $node->callback ( )
                ),
                $callbackVariables
              );
              
            }
            
          }
          
        }
        
      }
      
    }
    
    public function __destruct ( ) {
      
      array_walk (
        $this->tags,
        array (
          $this,
          'parseTags'
        )
      );
      echo $this->xmlWriter->outputMemory ( );
      
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
    
    public function autoloadCascadingStyleSheets ( ...$parameters ) {
      
      return $this->link (
        $this->attribute ( 'href', 'public/css/autoload.css' ),
        $this->attribute ( 'rel', 'stylesheet' )
      );
      
    }
    
  }
  
  $html5 = new html5 ( );
  
  $html5->html (
    $html5->attribute ( 'xmlns', 'http://www.w3.org/1999/xhtml' ),
    $html5->head (
      $html5->meta ( $html5->attribute ( 'charset', 'utf-8' ) ),
      $html5->title ( '' ),
      $html5->autoloadCascadingStyleSheets ( )
    ),
    $html5->body (
      
    )
  );