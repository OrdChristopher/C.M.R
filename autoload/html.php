<?php
  namespace application;
  
  class Html {
    
    private $xmlwriter = null;
    private $tagwriter = null;
    private $tag = null;
    
    public function __construct ( ) {
      
      $this->xmlwriter = new \XMLWriter ( );
      $this->xmlwriter->openMemory ( );
      $this->xmlwriter->startDocument ( '1.0', 'UTF-8' );
        $this->xmlwriter->writeDTD ( 'html' );
        $this->xmlwriter->startElement ( 'html' );
      
    }
    
    public function __call ( $name, $arguments ) {
      
      if ( $this->tagwriter !== null ) {

        $this->tagwriter->writeRaw ( $this->tagwriter->outputMemory ( ) );
        //$this->xmlwriter->endElement ( );
        //$this->tagwriter = null;
        
      }
      $result = call_user_func_array ( [ $this, "tag" ], [ $name, $arguments ] );
      
      return $result;
      
    }
    
    public function __destruct ( ) {
      
      if ( $this->tagwriter !== null ) {
        $this->xmlwriter->writeRaw ( $this->tagwriter->outputMemory ( ) );
        $this->xmlwriter->endElement ( );
      }
      $this->xmlwriter->endDocument ( );
      echo $this->xmlwriter->outputMemory ( );
      
    }
    
    public function tag ( $name, $arguments ) {
      
      $xmlwriter = new \XMLWriter ( );
      $xmlwriter->openMemory ( );
        $xmlwriter->startElement ( $name );
        
          foreach ( $arguments as $key => $value ) {
            
            if ( is_string ( $value ) ) {
              
              $xmlwriter->text ( $value );
              
            } else if ( is_object ( $value ) && method_exists ( $value, "run" ) ) {
              
              $value->run ( $xmlwriter );
              $xmlwriter->text ( "" );
              
            } else if ( is_object ( $value ) && $value instanceof \XMLWriter ) {

                if ( $this->tag === null ) {
                  
                  $this->xmlwriter->startElement ( $name );
                    $this->xmlwriter->writeRaw ( $value->outputMemory ( ) );
                    $this->tag = $name;
                  
                } elseif ( $this->tag == $name ) {
                  
                  $this->xmlwriter->writeRaw ( $value->outputMemory ( ) );
                  $this->xmlwriter->endElement ( );
                  $this->tag = null;
                  
                }
              
            }
            
          }
          
          if ( $this->tag == $name ) {
            
            $this->xmlwriter->endElement ( );
            $this->tag = null;
          
          }
          
        $xmlwriter->endElement ( );
        
      return $xmlwriter;
      
    }
    
    public function attribute ( $name, $content ) {
      
      return new Attribute ( $name, $content );
      
    }
    
  }
  
  class Attribute {
    
    public $name;
    public $content;
    
    public function __construct ( $name, $content = '' ) {
      
      $this->name = $name;
      $this->content = $content;
      
    }
    
    public function run ( $xmlwriter ) {
      
      $xmlwriter->writeAttribute ( $this->name, $this->content );
      
    }
    
  }
  
  $html = new Html ( );
  $html->head (
    $html->title ( "Html Head Title" ),
    $html->link ( 
      $html->attribute ( "href", "sess.css" ), 
      $html->link ( $html->attribute ( "href", "sess.css" ) )
    )
  );
  $html->body (
    $html->a ( $html->attribute ( "href", "sess.css" ), "SESS.CSS" )
  );