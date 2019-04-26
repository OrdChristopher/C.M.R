<?php
  namespace Application;
  
  $composer = require ( realpath ( __DIR__  . '/../../protected/vendor/autoload.php' ) );
  
  header ( 'Content-Type: application/json' );
  header ( 'Expires: 0' );
  header ( 'Last-Modified: '. gmdate('D, d M Y H:i:s') . ' GMT' );
  header ( 'Cache-Control: no-store, no-cache, must-revalidate' );
  header ( 'Cache-Control: post-check=0, pre-check=0', false );
  header ( 'Pragma: no-cache' );

  echo json_encode ( array (
    'https://code.jquery.com/jquery-3.3.1.slim.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
    'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.min.js',
    'public/js/blog.js'
  ) );
?>