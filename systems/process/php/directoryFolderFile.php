<?php
  
  class directoryFolderFile
  {
    
    // two delimiters; one uniquely followed by a constant delimiter, which may occur repeatedly singularly without consecutive repitition with data interlaced.
    // (*{1})(*{1})(.*[!$2])
    // C:\xampp\htdocs\systems\process\php\folder.php && !:\(.![\]*)
    public $character = null;
    public $linear_recurance = null;
    public $folder = null; // similar to base level clusters, however, predefined as 'folder.'
    public $delimiter = null;
    public $directory = null;
    public $file = null;
    
    public function __construct ( ) {
      
      $this->directoryFolderFile ( __FILE__ );
      
    }
    
    public function directoryFolderFile ( $fileFolder ) {
      
      // every character used within all folders and files uniquely within numerated list.
      $this->character = array ( ); // possible dual. 0 or 1 with differential values attached. ( ( $0=[0=$1,1=$0] ), ( $1=[0=$0] ) )
      
      // two delimiters; one uniquely followed by a constant delimiter, which may occur repeatedly singularly without consecutive repitition with data interlaced.
      $this->character = str_split ( $fileFolder );
      $this->linear_recurance = array ( );
      
      foreach ( $this->character as $index => $character ) {
        
        foreach ( $this->character as $reindex => $linear_recurance ) {
          
          if ( $index != $reindex && $character == $linear_recurance && !isset ( $this->linear_recurance [ $character ] ) ) {
            
            $this->linear_recurance [ $character ] = $index;
            break;
            
          }
          
        }
        
      }
      
      // delimiter one; first linear recurance of character. delimiter zero, before first occurance of delimiter one.
      $this->delimiter = array (
      
        1 => $this->character [ $linear_recurance = reset ( $this->linear_recurance ) ],
        0 => ( isset ( $this->character [ $linear_recurance -= 1 ] ) ? $this->character [ $linear_recurance ] : null )
      
      );
      
      $this->folder = explode ( $this->delimiter [ 1 ], $fileFolder );
      
      $this->file = array_pop ( $this->folder );
      $this->directory = array_shift ( $this->folder );
      
    }
    
  }

?>