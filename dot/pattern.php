<?php
  
  ini_set('memory_limit', '1280M');
  ini_set('upload_max_filesize', '128M');
  ini_set('post_max_size', '128M');
  ini_set('file_uploads', 'On');
  ini_set('max_execution_time', '300');
  ini_set('file_uploads', 'On');
  
  class pattern {
    
    public $englishSymbols = "abcdefghijklmnopqrstuvwxyz";
    public $englishPanagram = "The quick brown fox jumps over the lazy dog";
    //http://www.fun-with-words.com/pang_example.html
    public $englishPanagrams = array (
      "We promptly judged antique ivory buckles for the next prize.",
      "How razorback jumping frogs can level six piqued gymnasts.",
      "Sixty zippers were quickly picked from the woven jute bag.",
      "Crazy Fredrick bought many very exquisite opal jewels.",
      "Jump by vow of quick, lazy strength in Oxford.",
      "The quick brown fox jumps over the lazy dog.",
      "Pack my box with five dozen liquor jugs.",
      "How quickly daft jumping zebras vex.",
      "Sphinx of black quartz: judge my vow.",
      "Quick zephyrs blow, vexing daft Jim.",
      "Waltz, nymph, for quick jigs vex bud."
    );
    public $perfectEnglishPanagrams = array (
      "Mr. Jock, TV quiz PhD, bags few lynx.",
      "Cwm fjord-bank glyphs vext quiz.",
      "Blowzy night-frumps vex'd Jack Q.",
      "Squdgy fez, blank jimp crwth vox!",
      "TV quiz drag nymphs blew JFK cox.",
      "Q-kelt vug dwarf combs jynx phiz."
    );
    
    public function patternOfSymbols ( $symbols = array ( ) ) {
      
      // count; string or object
      if ( ( ( is_array ( $symbols ) || $symbols instanceof Countable ) && count ( $symbols ) > 0 ) || ( is_string ( $symbols ) && strlen ( $symbols ) > 0 ) ) {
        
        // cast as array
        if ( !is_array ( $symbols ) && is_string ( $symbols )  ) {
          
          $symbols = str_split ( $symbols );
          
        }
        
        $symbolsLength = sizeof ( $symbols );
        //resulting pattern arrays and string
        $resultPatternsString = array ( );
        $resultString = "";
        
        //plural, singular, singular of plural.
        foreach ( $symbols as $index => $symbol ) {
          
          $symbolLength = strlen ( $symbol );
          
          if ( $symbolLength == 1 && is_string ( $symbol ) ) {
            
            $ordinance = ord ( $symbol );
            // only receive character through language processing function of type.
            $character = chr ( $ordinance );
            $resultPatternsString [ 'characters' ] [ $character ] [ ] = $index;
            $resultString .= $character;
            
          }
          
        }
        
        $delimiter = null;
        $average = 1;
        //secondary character template parsing.
        foreach ( $resultPatternsString [ 'characters' ] as $character => $indexes ) {
          
          //a binary template of characters
          $template = array_fill ( 0, $symbolsLength, 0 );
          
          foreach ( $indexes as $key => $index ) {
            
            if ( isset ( $template [ $index ] ) ) {
              
              $template [ $index ] = 1;
              
            }
            
          }
          
          if ( is_null ( $delimiter ) ) {
            
            $count = sizeof ( $resultPatternsString [ 'characters' ] [ $character ] );
            $previousAverage = $average;
            $average = ( $count + 1 ) / count ( $resultPatternsString [ 'characters' ] );
            if ( $average >= 1 && $average > $previousAverage ) {
              
              $delimiter = $character;
              $average = 1;
              
            }
          
          }
          
          $resultPatternsString [ 'characters' ] [ $character ] [ 'template' ] = implode ( '', $template );
          
        }
        
        //group of symbols parsing ( words* )
        $resultPatternsString [ 'groups' ] = $this->groupOfSymbols ( $delimiter, $resultString );
        
        $groupsSize = 0;
        array_walk_recursive ( $resultPatternsString [ 'groups' ], function ( $x ) use ( &$groupsSize ) {
          
          $count = 1;
          
          if ( is_array ( $x ) ) {
            
            $count = count ( $x );
            
          }
          
          $groupsSize += $count;
          
        });
        
        //group endings ordered within 
        $delimiters = array ( );
        $average = 0;
        
        foreach ( $resultPatternsString [ 'groups' ] as $lowerCaseGroup => $indexes ) {
          
          foreach ( $resultPatternsString [ 'groups' ] as $lowerCaseGroupSecond => $indexesSecond ) {
            
            $lowerCaseGroupDifference = str_replace ( $lowerCaseGroup, '', $lowerCaseGroupSecond );
            if ( strlen ( $lowerCaseGroupDifference ) == 1 ) {
              
              
              $lowerCaseGroupDifferenceOrd = ord ( $lowerCaseGroupDifference );
              $lowerCaseGroupOrd = ord ( $lowerCaseGroup [ 0 ] );
              if ( round ( abs ( $lowerCaseGroupOrd - $lowerCaseGroupDifferenceOrd ), -2 ) == 100 && !in_array ( $lowerCaseGroupDifference, $delimiters ) ) {
                
                $delimiters [ ] = $lowerCaseGroupDifference;
              
              }
              
            }
            
          }
          
        }
        
        //secondary group template parsing.  
        foreach ( $resultPatternsString [ 'groups' ] as $lowerCaseGroup => $indexes ) {
          
          foreach ( $delimiters as $index => $delimiter ) {
            
            if ( strpos ( $lowerCaseGroup, $delimiter ) > -1 ) {
              
              $baseGroup = substr ( $lowerCaseGroup, 0, strlen ( $lowerCaseGroup ) - 1 );
              $reindexedGroup = array ( ( max ( array_keys ( $resultPatternsString [ 'groups' ] [ $lowerCaseGroup ] ) ) ) => $baseGroup );
              
              if ( isset ( $resultPatternsString [ 'groups' ] [ $baseGroup ] ) ) {
                
                $resultPatternsString [ 'groups' ] [ $baseGroup ] = $resultPatternsString [ 'groups' ] [ $baseGroup ] + $reindexedGroup;
              
              } else {
                
                $resultPatternsString [ 'groups' ] [ $baseGroup ] = array ( ( max ( array_keys ( $resultPatternsString [ 'groups' ] [ $lowerCaseGroup ] ) ) ) => $baseGroup  );
                
              }
              unset ( $resultPatternsString [ 'groups' ] [ $lowerCaseGroup ] );
              
            }
            
          }
          
          if ( isset ( $resultPatternsString [ 'groups' ] [ $lowerCaseGroup ] ) ) {
            
            //a binary template of groups
            $template = array_fill ( 0, $groupsSize, 0 );
            
            foreach ( $indexes as $index => $word ) {
              
              if ( isset ( $template [ $index ] ) ) {
                
                $template [ $index ] = 1;
                
              }
              
            }
            
            $resultPatternsString [ 'groups' ] [ $lowerCaseGroup ] [ 'template' ] = implode ( '', $template );
          
          }
          
        }
        
        
        
        $resultPatternsString [ 'string' ] = $resultString;
        
        //return result if count is greater than zero.
        return $resultPatternsString;
        
      }
      
    }
    
    public function groupOfSymbols ( $delimiter, $symbols ) {
      
      $words = array ( );
      
      if ( !is_array ( $symbols ) && is_string ( $symbols )  ) {
        
        //$matches = preg_split ( '/\s+/', $symbols, -1, PREG_SPLIT_NO_EMPTY );
        $matches = explode ( $delimiter, $symbols );

        for ( $index = 0, $size = sizeof ( $matches ); $index < $size; $index++ ) {
          
          //$word = str_replace ( $delimiters, '', $matches [ $index ] );
          $word = $matches [ $index ];
          $lowerCaseWord = strtolower ( $word );
          
          if ( !array_key_exists ( $lowerCaseWord, $words ) ) {
            
            $words [ $lowerCaseWord ] = array ( );
            $words [ $lowerCaseWord ] [ $index ] = $word;
            
          } else {
            
            $words [ $lowerCaseWord ] [ $index ] = $word;
            
          }
          
          
        }
      
      }
      
      return $words;
      
    }
    
  }
  
  $pattern = new pattern;
  $results = array ( );
  
  $panagrams = array ( implode ( " ", array_merge ( $pattern->perfectEnglishPanagrams, $pattern->englishPanagrams ) ) );
  //$panagrams = array ( $pattern->perfectEnglishPanagrams [ 1 ] );
  
  foreach ( $panagrams as $index => $englishPanagram ) {
    
    $result = $pattern->patternOfSymbols ( $englishPanagram );
    var_dump ( $results [ ] = $result );
    
  }