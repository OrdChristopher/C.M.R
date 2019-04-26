<?php
	class Curl
	{
		public static function Get ( $url, $referer = "" )
		{
			$options = array (
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER => false,
				CURLOPT_REFERER => $referer,
			);
			$handle = curl_init( $url );
			curl_setopt_array( $handle, $options );
			$response = curl_exec( $handle );
			curl_close( $handle );
			return $response;
		}
	}
?>