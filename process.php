<?php
	/*
	* ([\w]([.,?!;:-]["')\]}]?|["')\]}]?[.,?!;:-]))\K\s+(?=\w|[.,?!;:\-"')\]}])
	(\w([.?!]["')}\]]?|["'({[]?[.?!]))\K\s+(?=[A-Z"])
	*/
	
	$word_list = array ();
	$squares = array ();
	$cubes = array ();
	$fours = array ();
	$fives = array ();
	$sixes = array ();
	$sevens = array ();
	
	$newlines = array_filter ( explode ( "\n", $_POST[ 'w' ] ), 'trim' );
	//print_r($newlines);
	
	foreach($newlines as $newline_index => $newline_value)
	{
		$sentences = preg_split( "/(?<!\.\.\.)(?<=[.?!]|\.\))\s+(?=[a-z])/", $newline_value );
		//print_r( $sentences );
		foreach($sentences as $sentence_index => $sentence_value)
		{
			$words = array_filter ( explode ( ' ', $sentence_value ), 'trim' );
			foreach ( $words as $word_index => $word_value )
			{
				$words [$word_index] = trim ( trim ( $word_value ), "':,-!-().?\";[]{}()" );
			}
			$words = array_unique ( $words );
			
			$squared = array();
			$cubed = array();
			$fourd = array();
			$fived = array();
			$sixed = array();
			$sevened = array();
			
			$t = '';
			$s = 1;
			foreach ( $words as $word_index => $word_value )
			{
				if($s % 2 == 0) {
					if (!empty($t)) {
						$squared[] = "{$t} {$word_value}";
					}
					$t = '';
					$s++;
				}
				else
				{
					$t = $word_value;
					$s++;
				}
			}
			if(!empty($squared)) {
				$squares = array_merge($squares, $squared);
				$squared = array();
			}
			
			$t1 = '';
			$t = '';
			$s = 1;
			foreach ( $words as $word_index => $word_value )
			{
				if($s % 3 == 0) {
					if (!empty($t1) && !empty($t)) {
						$cubed[] = "{$t} {$t1} {$word_value}";
					}
					$t = '';
					$t1 = '';
					$s++;
				}else if($s % 2 == 0) {
					$t1 = $word_value;
					$s++;
				}
				else
				{
					$t = $word_value;
					$s++;
				}
			}
			if(!empty($cubed)) {
				$cubes = array_merge($cubes, $cubed);
				$cubed = array();
			}
			
			$t2 = '';
			$t1 = '';
			$t = '';
			$s = 1;
			foreach ( $words as $word_index => $word_value )
			{
				if($s % 4 == 0) {
					if (!empty($t2) &&!empty($t1) && !empty($t)) {
						$fourd[] = "{$t} {$t1} {$t2} {$word_value}";
					}
					$t = '';
					$t1 = '';
					$t2 = '';
					$s++;
				} else if($s % 3 == 0) {
					$t2 = $word_value;
					$s++;
				} else if($s % 2 == 0) {
					$t1 = $word_value;
					$s++;
				}
				else
				{
					$t = $word_value;
					$s++;
				}
			}
			if(!empty($fourd)) {
				$fours = array_merge($fours, $fourd);
				$fourd = array();
			}
			
			$t3 = '';
			$t2 = '';
			$t1 = '';
			$t = '';
			$s = 1;
			foreach ( $words as $word_index => $word_value )
			{
				if($s % 5 == 0) {
					if (!empty($t3) && !empty($t2) && !empty($t1) && !empty($t)) {
						$fived[] = "{$t} {$t1} {$t2} {$t3} {$word_value}";
					}
					$t = '';
					$t1 = '';
					$t2 = '';
					$t3 = '';
					$s++;
				} else if($s % 4 == 0) {
					$t3 = $word_value;
					$s++;
				} else if($s % 3 == 0) {
					$t2 = $word_value;
					$s++;
				} else if($s % 2 == 0) {
					$t1 = $word_value;
					$s++;
				}
				else
				{
					$t = $word_value;
					$s++;
				}
			}
			if(!empty($fived)) {
				$fives = array_merge($fives, $fived);
				$fived = array();
			}
			
			$t4 = '';
			$t3 = '';
			$t2 = '';
			$t1 = '';
			$t = '';
			$s = 1;
			foreach ( $words as $word_index => $word_value )
			{
				if($s % 6 == 0) {
					if (!empty($t4) && !empty($t3) && !empty($t2) && !empty($t1) && !empty($t) && !empty($word_value)) {
						$sixed[] = "{$t} {$t1} {$t2} {$t3} {$t4} {$word_value}";
					}
					$t = '';
					$t1 = '';
					$t2 = '';
					$t3 = '';
					$t4 = '';
					$s++;
				} else if($s % 5 == 0) {
					$t4 = $word_value;
					$s++;
				} else if($s % 4 == 0) {
					$t3 = $word_value;
					$s++;
				} else if($s % 3 == 0) {
					$t2 = $word_value;
					$s++;
				} else if($s % 2 == 0) {
					$t1 = $word_value;
					$s++;
				}
				else
				{
					$t = $word_value;
					$s++;
				}
			}
			if(!empty($sixed)) {
				$sixes = array_merge($sixes, $sixed);
				$sixed = array();
			}
			
			$t5 = '';
			$t4 = '';
			$t3 = '';
			$t2 = '';
			$t1 = '';
			$t = '';
			$s = 1;
			foreach ( $words as $word_index => $word_value )
			{
				if($s % 7 == 0) {
					if (!empty($t5) && !empty($t4) && !empty($t3) && !empty($t2) && !empty($t1) && !empty($t)) {
						$sevened[] = "{$t} {$t1} {$t2} {$t3} {$t4} {$t5} {$word_value}";
					}
					$t = '';
					$t1 = '';
					$t2 = '';
					$t3 = '';
					$t4 = '';
					$t5 = '';
					$s++;
				}else if($s % 6 == 0) {
					$t5 = $word_value;
					$s++;
				} else if($s % 5 == 0) {
					$t4 = $word_value;
					$s++;
				} else if($s % 4 == 0) {
					$t3 = $word_value;
					$s++;
				} else if($s % 3 == 0) {
					$t2 = $word_value;
					$s++;
				} else if($s % 2 == 0) {
					$t1 = $word_value;
					$s++;
				}
				else
				{
					$t = $word_value;
					$s++;
				}
			}
			if(!empty($sevened)) {
				$sevens = array_merge($sevens, $sevened);
				$sevened = array();
			}
			
			foreach ( $words as $word_index => $word_value )
			{
				if ( array_key_exists ( $word_value, $word_list ) )
				{
					$word_list [ $word_value ] ++;
				}
				else
				{
					$word_list [ $word_value ] = 1;
				}
			}
		}
	}
	$squares = array_not_unique($squares);
	$cubes = array_not_unique($cubes);
	$fours = array_not_unique($fours);
	$fives = array_not_unique($fives);
	$sixes = array_not_unique($sixes);
	$sevens = array_not_unique($sevens);
	
	print_r($squares);
	print_r($cubes);
	print_r($fours);
	print_r($fives);
	print_r($sixes);
	print_r($sevens);
	
	function array_not_unique($raw_array) {
		$dupes = array();
		natcasesort($raw_array);
		reset ($raw_array);

		$old_key    = NULL;
		$old_value    = NULL;
		foreach ($raw_array as $key => $value) {
			if ($value === NULL) { continue; }
			if ($old_value == $value) {
				$dupes[$old_key]    = $old_value;
				$dupes[$key]        = $value;
			}
			$old_value    = $value;
			$old_key    = $key;
		}
		return array_values ( array_unique ($dupes) );
	}
	
	
	//print_r( $sentences );
	
	
	
	
	//$links = array ( );
	
	/*foreach($sentences as $key1 => $value1)
	{
		$sentence_words = array_filter ( explode( ' ', $value1 ) );
		for( $index = 0, $length = sizeof( $sentence_words ); $index < $length; $index++ )
		{
			if ( isset ( $sentence_words [ $index ] ) )
			{
				$word = trim ( $sentence_words[$index], "':,-!-().?\";" );
				$percent = 1 / $length;
				if ( !array_key_exists ( $word, $links ) ) {
					$links [ $word ] = array ( );
					foreach( $sentence_words as $key => $value ) {
						$word2 = trim ( $value, "':,-!-().?\";" );
						$position = $index - $key;
						if ( $key != $index && !empty ( $word2 ) ) {
							$links [ $word ] [ $word2 ] = $percent;
						}
					}
				} else {
					foreach( $sentence_words as $key => $value ) {
						$word2 = trim ( $value, "':,-!-().?\";" );
						if ( $key != $index && !empty ( $word2 ) ) {
							if ( !array_key_exists ( $word2, $links [ $word ] ) ) {
								//$links [ $word ] [ $word2 ] = $percent;
							} else {
								$links [ $word ] [ $word2 ] = ( $links [ $word ] [ $word2 ] + $percent ) / 2;
							}
						}
					}
				}
			}
		}
	}*/
	
	//print_r ( $links );
?>
<!DOCTYPE html>
<html>
  <head>
  </head>

  <body>
    <form method="post">
      <textarea type="text" name="w"></textarea>
      <input type="submit" value="parse" />
    </form>
  </body>
</html>