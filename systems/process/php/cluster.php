<?php

  class cluster {
    
    public $character = null;
    public $character_cluster = null;
    
    public function __construct ( $cluster ) {
      
      $unicodeData = explode ( "\n", file_get_contents ( "UnicodeData.txt" ) );
      
      for ( $index = 0, $size = sizeof ( $unicodeData ); $index < $size; $index++ ) {
        
        $unicode = explode ( ';', $unicodeData [ $index ] );
        $symbol = $unicode [ 0 ];
        $cluster = $unicode [ 1 ];
        if ( !empty ( $cluster ) && !isset ( $this->character_cluster [ $cluster ] ) ) {
        
          $this->character_cluster [ $cluster ] = $this->unicode ( $symbol );
          
        }
        
      }
      
    }
    
    function unicode ( $u ) {
      return chr ( hexdec ( $u ) );
      
      
    }
    
  }

?>