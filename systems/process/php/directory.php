<?php
  
  class directoryFolderFile
  {
    
    // two delimiters; one uniquely followed by a constant delimiter, which may occur repeatedly singularly without consecutive repitition with data interlaced.
    // (*{1})(*{1})(.*[!$2])
    // C:\xampp\htdocs\systems\process\php\folder.php && !:\(.![\]*)
    public $character = null;
    public $folder = null;
    public $delimiter = null;
    public $file = null;
    public $document = null;
    
    public function __construct ( ) {
      
      // every character used within all folders and files uniquely within numerated list.
      $this->character = array ( ); // possible dual. 0 or 1 with differential values attached. ( ( $0=[0=$1,1=$0] ), ( $1=[0=$0] ) )
      
      // two delimiters; one uniquely followed by a constant delimiter, which may occur repeatedly singularly without consecutive repitition with data interlaced.
      $this->delimiter = array ( ':', '\\' );
      $this->delimiter = array (
        
        $variable->regex ( '/^[a-z](.*[a-z])?$/igm' )
        
      );
      
    }
    
  }

?>