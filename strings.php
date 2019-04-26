<?php
	class Strings
	{
		public static $hashtag_regex = '/(#[\w\.-]+)/u';
		public static $mention_regex = '/(@[\w\.-]+)/u';
		public static $word_regex = '/[^\w\'-]+/u';
		
		public static function Generate($character_count = 1, $character_limit = 3)
		{
			$character_sets = array();
			while($character_count <= $character_limit)
			{
				$character_set = array();
				for($index = 0; $index < 26; $index++)
				{
					$character = chr(97 + $index);
					for($character_set_index = 0; $character_set_index < sizeof($character_sets); $character_set_index++)
					{
						foreach($character_sets[$character_set_index] as $key => $value)
						{
							$character_set[] = $value . $character;
						}
					}
					$character_set[] = $character;
				}
				$character_sets[] = $character_set;
				$character_count++;
			}
			return json_encode( Words::Had_Vowels( array_values( array_unique ( array_merge( ...$character_sets ) ) ) ) );
		}
		
		public static function Had_Vowels( $words )
		{
			$had_vowels = array( );
			foreach( $words as $key => $value )
			{
				if( preg_match( '/[aeiou]/i', strtolower( $value ) ) )
				{
					$had_vowels[ ] = strtolower( $value );
				}
			}
			return $had_vowels;
		}
		
		public static function Hashtags( $text )
		{
			$hashtags = array( );
			preg_match_all( Strings::$hashtag_regex, strtolower( $text ), $matches );
			if( $matches )
			{
				$hashtagsArray = array_count_values( $matches[ 0 ] );
				$hashtags = array_keys( $hashtagsArray );
			}
			return array_filter( array_unique( array_map( 'Strings::WithoutConsecutiveDashDot', array_map( 'trim', $hashtags ) ) ), 'strlen' );
		}
		
		public static function WithoutHashtags( $text )
		{
			return preg_replace( Strings::$hashtag_regex, ' ', $text );
		}
		
		public static function Mentions( $text )
		{
			$mentions = array( );
			preg_match_all( Strings::$mention_regex, strtolower( $text ), $matches );
			if( $matches )
			{
				$mentionsArray = array_count_values( $matches[ 0 ] );
				$mentions = array_keys( $mentionsArray );
			}
			return array_filter( array_unique( array_map( 'Strings::WithoutConsecutiveDashDot', array_map( 'trim', $mentions ) ) ), 'strlen' );
		}
		
		public static function WithoutMentions( $text )
		{
			return preg_replace( Strings::$mention_regex, ' ', $text );
		}
		
		public static function WithoutConsecutiveDashDot( $text )
		{
			$text = preg_replace( '/([\.-]+)\\1+/', '', $text );
			return ( ( $text == '@' || $text == '#' ) ? null : $text );
		}
		
		public static function ArrayOfDuplicates( $array1 )
		{
			$array2 = array( );
			$array3 = array( );
			foreach( $array1 as $key => $value )
			{
				if( in_array( $value, $array2 ) )
				{
					if( !in_array( $value, $array3 ) )
					{
						array_push( $array3, $value );
					}
				}
				else
				{
					array_push( $array2, $value );
				}
			}
			return $array3;
		}
	}
?>