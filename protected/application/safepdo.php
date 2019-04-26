<?php
  namespace Application;
  
  class SafePDO extends \PDO {
    
    public static function exception_handler ( $exception ) {
      die ( 'Uncaught exception: '. $exception->getMessage ( ) );
    }

    public function __construct ( $dsn, $username = '', $password = '', $driver_options = array ( ) ) {
      set_exception_handler ( array ( __CLASS__, 'exception_handler' ) );
      parent::__construct ( $dsn, $username, $password, $driver_options );
      restore_exception_handler ( );
    }
    
  }