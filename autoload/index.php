<?php
  namespace application;
  
  class index {
    
    public function __construct ( ) {
      
      set_error_handler ( array ( $this, 'error' )  );
      set_exception_handler ( array ( $this, 'exception' ) );
      spl_autoload_register ( array ( $this, 'autoload' ) );
      $this->index ( );
      
    }
    
    public function index ( ) {
      
      $realpath = realpath ( dirname ( __FILE__ ) );
      $request_uri = rtrim ( $_SERVER [ 'REQUEST_URI' ], '/' );
      $xmlwriter = new \XMLWriter ( );
      $xmlwriter->openMemory ( );
      $xmlwriter->setIndent ( true );
      $xmlwriter->startDocument ( '1.0', 'UTF-8' );
        $xmlwriter->writeDTD ( 'html' );
        $xmlwriter->startElement ( 'html' );
          $xmlwriter->startElement ( 'head' );
            $xmlwriter->startElement ( 'title' );
              $xmlwriter->text ( 'Index of ' . $request_uri );
            $xmlwriter->endElement ( );
          $xmlwriter->endElement ( );
          $xmlwriter->startElement ( 'body' );
            $xmlwriter->startElement ( 'h1' );
              $xmlwriter->text ( 'Index of ' . $request_uri );
            $xmlwriter->endElement ( );
            $xmlwriter->startElement ( 'table' );
              $xmlwriter->startElement ( 'tr' );
                $xmlwriter->startElement ( 'th' );
                  $xmlwriter->text ( 'Name' );
                $xmlwriter->endElement ( );
                $xmlwriter->startElement ( 'th' );
                  $xmlwriter->text ( 'Last Modified' );
                $xmlwriter->endElement ( );
                $xmlwriter->startElement ( 'th' );
                  $xmlwriter->text ( 'Size' );
                $xmlwriter->endElement ( );
                $xmlwriter->startElement ( 'th' );
                  $xmlwriter->text ( 'Description' );
                $xmlwriter->endElement ( );
              $xmlwriter->endElement ( );
              $xmlwriter->startElement ( 'tr' );
                $xmlwriter->startElement ( 'td' );
                  $xmlwriter->startElement ( 'a' );
                    $xmlwriter->writeAttribute ( 'href', '..' );
                    $xmlwriter->text ( 'Parent Directory' );
                  $xmlwriter->endElement ( );
                $xmlwriter->endElement ( );
              $xmlwriter->endElement ( );
              
              $dir = scandir ( $realpath );
              foreach ( $dir as $key => $value ) {
                
                if($value === '.' || $value === '..') {
                  
                  continue;
                  
                } 
                $xmlwriter->startElement ( 'tr' );
                  $xmlwriter->startElement ( 'td' );
                    $xmlwriter->startElement ( 'a' );
                      $xmlwriter->writeAttribute ( 'href', $value );
                      $xmlwriter->text ( $value );
                    $xmlwriter->endElement ( );
                  $xmlwriter->endElement ( );
                  $xmlwriter->startElement ( 'td' );
                    $xmlwriter->text ( date ( 'F d Y H:i:s', filemtime ( $value ) ) );
                  $xmlwriter->endElement ( );
                  $xmlwriter->startElement ( 'td' );
                    $xmlwriter->text ( filesize ( $value ) );
                  $xmlwriter->endElement ( );
                $xmlwriter->endElement ( );
                
              }
              
            $xmlwriter->endElement ( );
          $xmlwriter->endElement ( );
        $xmlwriter->endElement ( );
      $xmlwriter->endDocument ( );
      echo $xmlwriter->outputMemory ( );
      
    }
    
    public static function autoload ( $class_name ) {
      
      if ( file_exists ( $class_name ) ) {
        
        return require_once ( $class_name );
        
      }
      
      return false;
      
    }
    
    public static function error ( $errorNumber, $errorString, $errorFile, $errorLine ) {
      
      if ( !( error_reporting ( ) & $errorNumber ) ) {
        
        return false;
        
      }

      switch ( $errorNumber ) {
        
        case E_USER_ERROR:
          echo "<b>My ERROR</b> [$errorNumber] $errorString<br />\n";
          echo "  Fatal error on line $errorLine in file $errorFile";
          echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
          echo "Aborting...<br />\n";
          exit ( 1 );
          break;

        case E_USER_WARNING:
          echo "<b>My WARNING</b> [$errorNumber] $errorString<br />\n";
          break;

        case E_USER_NOTICE:
          echo "<b>My NOTICE</b> [$errorNumber] $errorString<br />\n";
          break;

        default:
          echo "Unknown error type: [$errorNumber] $errorString<br />\n";
          break;
          
      }
      
      return true;
      
    }
    
    public static function exception ( $exception ) {
      
      echo "Uncaught exception: " , $exception->getMessage ( ), "\n";
      
    }
    
  }
  
  new index ( );
  //new Test();
?>