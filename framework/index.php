<?php
  namespace application;
  
  class index {
    
    public $path;
    public $control;
    public $model;
    public $view;
    
    public function __construct ( ) {
      
      $this->handles ( );
      $this->definitions ( );
      
      $control = ( sizeof ( PATH [ 'parameters' ] ) >= 1 ) ? PATH [ 'parameters' ] [ 0 ] : 'index';
      $model = "application\\model\\{$control}";
      $view = "application\\view\\{$control}";
      $control = "application\\control\\{$control}";
      $this->control = new $control ( $this->model = new $model ( ) );
      $this->view = new $view ($this->control, $this->model );
    }
    
    public function handles () {
      
      set_error_handler ( array ( $this, 'error' )  );
      set_exception_handler ( array ( $this, 'exception' ) );
      spl_autoload_register ( array ( $this, 'autoload' ) );
      
    }
    
    public function definitions ( ) {
      
      define ( 'DS', DIRECTORY_SEPARATOR );
      define ( 'US', '/' );
      define ( 'ROOT', getcwd ( ) . DS );
      $base_path = str_replace ( DS, US, str_replace ( str_replace ( US, DS, $_SERVER [ 'DOCUMENT_ROOT' ] ), '', ROOT ) );
      $path = array (
        'scheme' => $_SERVER [ 'REQUEST_SCHEME' ],
        'host' => $_SERVER [ 'HTTP_HOST' ],
        'root' => $base_path,
        'request' => $_SERVER [ 'REQUEST_URI' ],
        'canonical' => '',
        'full_path' => '',
        'parameters' => array ( )
      );
      $path [ 'request' ] = ( strpos ( $path [ 'request' ], $base_path ) == 0 ) ? substr ( $path [ 'request' ], strlen ( $base_path ), ( strlen ( $path [ 'request' ] ) - strlen ( $base_path ) ) ) : $path [ 'request' ];
      $path [ 'canonical' ] =  $path [ 'scheme' ] . ':' . US . US . $path [ 'host' ] . $path [ 'root' ];
      $path [ 'full_path' ] = $path [ 'canonical' ] . $path [ 'request' ];
      $path [ 'parameters' ] = array_filter ( explode ( US, $path [ 'request' ] ) );
      define ( 'PATH', $path );
      
    }
    
    public static function autoload ( $class_name ) {
      
      $file = 'private\\' . $class_name . '.php';
      
      if ( file_exists ( $file ) ) {
        
        return require_once ( $file );
        
      }
      
      return false;
      
    }
    
    public static function error ( $number, $string, $file, $line ) {
      
      if ( ( error_reporting ( ) & $number ) === false ) {
        
        return false;
        
      }

      switch ( $number ) {
        
        case E_USER_ERROR:
          //exit ( 1 );
          break;

        case E_USER_WARNING:
          break;

        case E_USER_NOTICE:
          break;

        default:
          break;
          
      }
      
      echo "error";
      echo $string . $line;
      
      return true;
      
    }
    
    public static function exception ( $exception ) {
      
      //echo "exception";
      //echo $exception->getMessage ( );
      //echo $exception->getTraceAsString();
      //var_dump ( $exception );
      
    }
    
  }
  
  $index = new index ( );
?>