<?php
  ini_set('memory_limit', '1280M');
  ini_set('upload_max_filesize', '128M');
  ini_set('post_max_size', '128M');
  ini_set('file_uploads', 'On');
  ini_set('max_execution_time', '300');
  ini_set('file_uploads', 'On');
  
  require_once ( "database.php" );

  class dictionary {
    
    private $database = null;
    private $dictionary = null;
    
    public function __construct ( $jsonFilePath = "words_dictionary.json" ) {
      
      $this->database = new database;
      $this->dictionary = json_decode ( file_get_contents ( $jsonFilePath ), true );
      
    }
    
    public function hasWord ( $word ) {
      
      if ( sizeof ( $rows = $this->database->select ( 'words', array ( 'id', 'rate' ), array ( 'word' ), array ( 'word' => $word ) ) ) > 0 ) {
        
        return true;
        
      }
      
      return false;
      
    }
    
    public function rootWords ( $word ) {
    
      $rootWords = array ( );
      $wordLength = strlen ( $word );
      
      if ( $wordLength > 1 ) {
        
        $possibleRoot = array ( );
        
        for ( $index = 0, $size = $wordLength - 1; $index < $size; $index++ ) {
          
          $rootWord = substr ( $word, $index, $size - $index );
          
          if ( !in_array ( $rootWord, $possibleRoot ) ) {
            
            $possibleRoot [ ] = $rootWord;
          
          }
          
        }
        
        for ( $index = $wordLength - 1; $index > 0; $index-- ) {
          
          $rootWord = substr ( $word, 0, $index );
          
          if ( !in_array ( $rootWord, $possibleRoot ) ) {
            
            $possibleRoot [ ] = $rootWord;
          
          }
          
        }
        
        for ( $index = 1, $size = $wordLength; $index < $size; $index++ ) {
          
          $rootWord = substr ( $word, $index, $size - $index  );
          
          if ( !in_array ( $rootWord, $possibleRoot ) ) {
            
            $possibleRoot [ ] = $rootWord;
          
          }
          
        }
        
        for ( $index = $wordLength; $index > 1; $index-- ) {
          
          $rootWord = substr ( $word, 1, $index  );
          
          if ( !in_array ( $rootWord, $possibleRoot ) ) {
            
            $possibleRoot [ ] = $rootWord;
          
          }
          
        }
        
        foreach ( $possibleRoot as $key => $value ) {
          
          if ( $this->hasWord ( $value ) ) {
            
            if ( strlen ( $value ) > 1 && !in_array ( $value, $rootWords ) ) {
              
              $rootWords [ ] = $value;
            
            }
            
          } else {
            
            $rootWords = array_unique ( array_merge ( $rootWords, $this->rootWords ( $rootWord ) ) );
            
          }
         
        }
        
      }
      
      usort ( $rootWords, function ( $a, $b ) {
        
        return strlen ( $a ) - strlen ( $b ) ?: strcmp ( $a, $b );
        
      } );
      
      return $rootWords;
    
    }
    
  }
  
  $dictionary = new dictionary;
  $database = new database;
  $word = '';
  
  if ( isset ( $_GET [ 'word' ] ) ) {
    
    $word = $_GET [ 'word' ];
    
  }
  
  
  $rows = $database->sql ( "SELECT `id`, `rate` FROM `words` WHERE `word` = '" . $word . "'" );
  
  if ( sizeof ( $rows ) == 1 ) {
    
    $id = $rows [ 0 ] [ 'id' ];
    $rate = $rows [ 0 ] [ 'rate' ];
    
    echo "<h1>Word</h1><a href='?search=word&word=" . $word . "'>" . $word . "</a> (" . ( $rate * 100 ) . "%)\r\n";
    
    echo "<h2>Link</h2>\r\n";
    
    $rows = $database->sql ( "SELECT `charge`, `rate`, `word_x`, `word_y` FROM `links` WHERE `word_x` = '" . $id . "' OR `word_y` = '" . $id . "'" );
    
    if ( sizeof ( $rows ) > 0 ) {
      
      foreach ( $rows as $key => $value ) {
        
        $rate = $value [ 'rate' ];
        $charge = $value [ 'charge' ];
        $id_x = $value [ 'word_x' ];
        $id_y = $value [ 'word_y' ];
        $rowsWords = $database->sql ( "SELECT `word` FROM `words` WHERE `id` = '" . $id_x . "' OR `id` = '" . $id_y . "'" );
        
        if ( sizeof ( $rowsWords ) == 2 ) {
          
          $word_x = $rowsWords [ 0 ];
          $word_y = $rowsWords [ 1 ];
          
          if ( $word_x != $word ) {
            
            $word_x = $word_y;
            
          }
          
          echo "<a href='?search=word&word=" . $word_x [ 'word' ] . "'>" . $word_x [ 'word' ] . "</a> " . ( $charge == 1 ? '==' : '!='  ) . " (" . ( $rate * 100 ) . "%)</p>\r\n";
          
        }
        
      }
      
    }
    
    echo "<h3>Secondary Link</h3>\r\n";
    
    echo "<h4>Root</h4>\r\n";
    
    foreach ( $dictionary->rootWords ( $word ) as $key => $value ) {
      
      echo "<a href='?search=word&word=" . $value . "'>" . $value . "</a> ";
      
    }
    
  }
  
  echo "<br /><br /><h5>Option</h5>\r\n";
    
    echo "<form><input type='hidden' name='search' value='word' /><input type='text' name='word' placeholder='search word' value='' /> <input type='submit' value='search'/></form>";
    
    echo "<form><input type='hidden' name='link' value='" . $word . "' /><input type='text' name='word' placeholder='link word' value='' /> <select name='charge'><option value='0'>antonym</option><option value='1' selected='true'>synonym</option></select> <input type='submit' value='link'/></form>";
    echo "<form><input type='hidden' name='unlink' value='" . $word . "' /><input type='text' name='word' placeholder='unlink word' value='' /> <select name='charge'><option value='0'>antonym</option><option value='1' selected='true'>synonym</option></select> <input type='submit' value='unlink'/></form>";
  
  if ( isset ( $_GET [ 'link' ] ) ) {
    
    $word_x = $_GET [ 'link' ];
    $word_y = $_GET [ 'word' ];
    $charge = $_GET [ 'charge' ];
    $rows = $database->sql ( "SELECT `id`, `rate` FROM `words` WHERE `word` = '" . $word_x . "' OR `word` = '" . $word_y . "'" );
    
    if ( sizeof ( $rows ) < 2 ) {
      
      $database->insert ( 'words', array ( 'word' ), array ( 'word' => $word_y ) );
      $rows = $database->sql ( "SELECT `id`, `rate` FROM `words` WHERE `word` = '" . $word_x . "' OR `word` = '" . $word_y . "'" );
      
    }
    
    if ( sizeof ( $rows ) == 2 ) {
      
      $id_x = $rows [ 0 ] [ 'id' ];
      $id_y = $rows [ 1 ] [ 'id' ];
      $rows = $database->sql ( "SELECT `id`, `rate` FROM `links` WHERE `word_x` = '" . $id_x . "' AND `word_y` = '" . $id_y . "'" );
      
      if ( sizeof ( $rows ) == 0 ) {
        
        $database->insert ( 'links', array ( 'word_x', 'word_y', 'charge' ), array ( 'word_x' => $id_x, 'word_y' => $id_y, 'charge' => $charge ) );
        
      } elseif ( sizeof ( $rows ) == 1 ) {
        
        $rate = ( ( $rows [ 0 ] [ 'rate' ] + 1 ) / 2 );
        $database->sql ( "UPDATE links SET rate = " . $rate . " WHERE word_x = " . $id_x . " AND word_y = " . $id_y );
        
      }
      
    }
    
  }
  
  if ( isset ( $_GET [ 'unlink' ] ) ) {
    
    $word_x = $_GET [ 'unlink' ];
    $word_y = $_GET [ 'word' ];
    $charge = $_GET [ 'charge' ];
    
    $rows = $database->sql ( "SELECT `id`, `rate` FROM `words` WHERE `word` = '" . $word_x . "' OR `word` = '" . $word_y . "'" );
    
    if ( sizeof ( $rows ) == 2 ) {
      
      $id_x = $rows [ 0 ] [ 'id' ];
      $id_y = $rows [ 1 ] [ 'id' ];
      $rows = $database->sql ( "SELECT `id`, `rate` FROM `links` WHERE `charge` = '" . $charge . "' AND `word_x` = '" . $id_x . "' AND `word_y` = '" . $id_y . "'" );
      
      if ( sizeof ( $rows ) == 1 ) {
        
        $rate = ( $rows [ 0 ] [ 'rate' ] / 2 );
        $database->sql ( "UPDATE links SET rate = " . $rate . " WHERE word_x = " . $id_x . " AND word_y = " . $id_y );
        
      }
      
    }
    
  }
  
  if ( isset ( $_GET [ 'add' ] ) && $_GET [ 'add' ] == 'word' ) {
    
    if ( sizeof ( $rows = $database->select ( 'words', array ( 'id', 'rate' ), array ( 'word' ), array ( 'word' => $word ) ) ) == 0 ) {
    
      $database->insert ( 'words', array ( 'word' ), array ( 'word' => $word ) );
    
    } else {
      
      if ( ( $rate = $rows [ 0 ] [ 'rate'] ) != ( ( $rate + 1 ) / 2 ) ) {
      
        $database->update ( 'words', array ( 'rate' ), array ( 'id' ), array ( 'rate' => ( ( $rate + 1 ) / 2 ), 'id' => $rows [ 0 ] [ 'id'] ) );
      
      }
      
    }
    
  }
  
  echo "<form><input type='hidden' name='add' value='word' /><input type='text' name='word' placeholder='add word' value='' /> <input type='submit' value='add'/></form>";
  
  if ( isset ( $_GET [ 'minus' ] ) && $_GET [ 'minus' ] == 'word' ) {
    
    if ( sizeof ( $rows = $database->select ( 'words', array ( 'id', 'rate' ), array ( 'word' ), array ( 'word' => $word ) ) ) != 0 ) {
      
      if ( ( $rate = $rows [ 0 ] [ 'rate'] ) != ( $rate / 2 ) ) {
      
        $database->update ( 'words', array ( 'rate' ), array ( 'id' ), array ( 'rate' => ( $rate / 2 ), 'id' => $rows [ 0 ] [ 'id'] ) );
      
      }
    
    }
    
  }
    
  echo "<form><input type='hidden' name='minus' value='word' /><input type='text' name='word' placeholder='minus word' value='' /> <input type='submit' value='minus'/></form>";
    
  header ( "location: dictionary.php?search=word&word=" . $word );