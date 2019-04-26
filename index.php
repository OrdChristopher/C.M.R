<?php
  namespace Application;
  
  $composer = require ( realpath ( __DIR__  . '/protected/vendor/autoload.php' ) );
  
  use Application\SQLite;
  
  $sqlite = new SQLite ( );
  if ( $sqlite->connected ( ) ) {
    echo 'Connected';
  }