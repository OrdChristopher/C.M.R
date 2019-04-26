<?php
  namespace application;
  
  ini_set ( 'max_execution_time', 300 );
  
  function words ( $number ) {
    
    $alphabet = array ( 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z' );
    $words = $alphabet;
    $position = 1;
    while ( $position < $number ) {
      
      for ( $wordIndex = 0, $wordSize = sizeof ( $words ); $wordIndex < $wordSize; $wordIndex++ ) {
        
        $word = isset ( $words [ $wordIndex ] ) ? $words [ $wordIndex ] : '';
        for ( $index = 0, $size = sizeof ( $alphabet ); $index < $size; $index++ ) {
          
          $letter = $alphabet [ $index ];
          $newWord = $word . $letter;
          if ( !in_array ( $newWord, $words ) && preg_match_all ( '/[aeiou]/i', $newWord, $matches ) ) {
            
            array_push ( $words, $newWord );
          
          }
          
        }
        
      }
      
      $position++;
    
    }
    
    return $words;
    
  }
  
  print_r ( words ( $_GET [ 'n' ] ) );
?>