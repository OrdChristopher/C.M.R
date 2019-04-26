<?php
	require_once( 'curl.php' );
	require_once( 'strings.php' );
	require_once( 'hashtag.php' );
	
	class Instagram
	{
		public function Search( $query )
		{
			$query = urlencode( strtolower( $query ) );
			$response = Curl::Get( 'https://www.instagram.com/web/search/topsearch/?context=blended&query=%23' . $query );
			$json = json_decode( $response );
			foreach( $json->hashtags as $key => $value )
			{
				$name = strtolower( $value->hashtag->name );
				if( $name == $query )
				{
					return new Hashtag($value->hashtag);
				}
			}
		}
		
		public function Explore ( $hashtag )
		{
			$hashtag = urlencode( strtolower( $hashtag ) );
			$response = Curl::Get( "https://www.instagram.com/explore/tags/{$hashtag}/" );
			$json = json_decode( $this->SharedEvent( $response ) );
			$edges = $json->entry_data->TagPage[ 0 ]->graphql->hashtag->edge_hashtag_to_media->edges;
			$words = array( );
			$hashtags = array( );
			$mentions = array( );
			$shortcodes = array( );
			foreach( $edges as $key => $value )
			{
				if( isset( $value->node->edge_media_to_caption->edges[ 0 ] ) )
				{
					$text = trim( $value->node->edge_media_to_caption->edges[ 0 ]->node->text );
					$hashtags = array_merge( $hashtags, Strings::Hashtags( $text ) );
					$text = trim( Strings::WithoutHashtags( $text ) );
					$mentions = array_merge( $mentions, Strings::Mentions( $text ) );
					$text = trim( Strings::WithoutMentions( $text ) );
					$text = preg_replace( Strings::$word_regex, ' ', $text );
					$words = Strings::Had_Vowels( array_merge( $words, array_unique( array_map( 'trim', array_filter( explode( ' ', $text ), 'strlen' ) ) ) ) );
				}
				$shortcodes[ ] = $value->node->shortcode;
			}
			$words = Strings::ArrayOfDuplicates( $words );
			$hashtags = Strings::ArrayOfDuplicates( $hashtags );
			$mentions = Strings::ArrayOfDuplicates( $mentions );
			return $hashtags;
		}
		
		public static function SharedEvent( $html )
		{
			$shared_data = 'window._sharedData = ';
			$offset = ( strpos( $html, $shared_data, 0 ) + strlen ( $shared_data ) );
			return substr( $html, $offset, ( strpos( $html, ';</script>', $offset ) - $offset ) );
		}
	}
?>