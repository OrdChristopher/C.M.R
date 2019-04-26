<?php
  
  ini_set('memory_limit', '1280M');
  ini_set('upload_max_filesize', '128M');
  ini_set('post_max_size', '128M');
  ini_set('file_uploads', 'On');
  ini_set('max_execution_time', '300');
  ini_set('file_uploads', 'On');
  
  $cookieWords = array ( );
  
  if ( is_array ( $_COOKIE [ 'cookieWords' ] ) ) {
    
    $cookieWords = $_COOKIE [ 'cookieWords' ];
  
  }
  
  
      
      /*
      $nestedWords = array ( 'prefix' => array ( ), 'suffix' => array ( ) );
      foreach ( $words as $fixation => $fixWords ) {
        
        if ( is_array ( $fixWords ) ) {
          
          foreach ( $fixWords as $key => $value ) {
          
            if ( strlen ( $value ) > 2 ) {
              
              $roots = wordRoots ( $value );
              
              if ( empty ( $roots [ 'prefix' ] ) || sizeof ( $roots [ 'prefix' ] ) == 0 ) {
                
                //unset ( $roots [ 'prefix' ] );
                
              }
              
              if ( empty ( $roots [ 'suffix' ] ) || sizeof ( $roots [ 'suffix' ] ) == 0 ) {
                
                //unset ( $roots [ 'suffix' ] );
                
              }
              
              if ( empty ( $roots ) || sizeof ( $roots ) == 0 ) {
                
                $nestedWords [ $fixation ] [  ] = $value;
                
              } else {
                
                $nestedWords [ $fixation ] [ $value ] = $roots;
              
              }
              
            }
          
          }
          
        }
        
      }
    
    }
    
    if ( empty ( $nestedWords [ 'prefix' ] ) || sizeof ( $nestedWords [ 'prefix' ] ) == 0 ) {
      
      unset ( $nestedWords [ 'prefix' ] );
      
    }
    if ( empty ( $nestedWords [ 'suffix' ] ) || sizeof ( $nestedWords [ 'suffix' ] ) == 0 ) {
      
      unset ( $nestedWords [ 'suffix' ] );
      
    }
    
    return $nestedWords;
  }
    
  }*/
  
  
  $word = "suffix";
  //$ret = wordRoots ( $word );
  var_dump ( $ret );
  
  echo "<br /><br />";
  
  /*foreach ( $cookieWords as $key => $value ) {
    
    echo 'WORD : "' . $key . '"<br /><br />SYNONYM : "", "", ...<br /><br />ANTONYM : "", "", ...<br /><br />';
    
  }*/
?>

<form method="post">
add text <input type="text" name="text" value="" /> <input type="submit" value="add" />
</form>
<form method="post">
add word <input type="text" name="word" value="" /> <input type="submit" value="add" />
</form>
<form method="post">
add synonym <input type="text" name="synonym" value="" /> for <select name="value">
</select> <input type="submit" value="add" />
</form>
<form method="post">
add antonym <input type="text" name="antonym" value="" /> for <select name="value">
</select> <input type="submit" value="add" />
</form>