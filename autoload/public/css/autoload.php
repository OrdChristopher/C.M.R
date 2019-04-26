<?php
  namespace application;
  
  header ( 'Content-Type: text/css' );
  header ( 'Expires: 0' );
  header ( 'Last-Modified: '. gmdate('D, d M Y H:i:s') . ' GMT' );
  header ( 'Cache-Control: no-store, no-cache, must-revalidate' );
  header ( 'Cache-Control: post-check=0, pre-check=0', false );
  header ( 'Pragma: no-cache' );
  
  $css = array (
    'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css',
    'http://getbootstrap.com/docs/4.1/examples/blog/blog.css',
    'https://fonts.googleapis.com/css?family=Cairo|Comfortaa|Crimson+Text|Fjalla+One|Merriweather+Sans|Noto+Serif|Varela+Round',
    'https://use.fontawesome.com/releases/v5.4.1/css/all.css',
    'blog.css'
  );
  
  //$_SERVER [ 'HTTP_REFERER' ], should lead to required css for specific view through mvc
  
  foreach ( $css as $key => $value ) {
    
    echo "@import url(\"{$value}\");\r\n";
    
  }
?>