<?php
	function GetMeanRGB( $image )
	{
		$mean = 0;
		$width = imagesx( $image );
		$height = imagesy( $image );
		for( $x = 0; $x < $width; $x++ )
		{
			for( $y = 0; $y < $height; $y++ )
			{
				$mean += imagecolorat( $image, $x, $y );
			}
		}
		return round ( $mean / ( $width * $height ) );
	}
	
	function SubtractMeanRGB( $image )
	{
		$mean = GetMeanRGB( $image );
		$width = imagesx( $image );
		$height = imagesy( $image );
		for( $x = 0; $x < $width; $x++ )
		{
			for( $y = 0; $y < $height; $y++ )
			{
				imagesetpixel( $image, $x, $y, ( imagecolorat( $image, $x, $y ) - $mean ) );
			}
		}
	}
	
	$image = imagecreatefrompng( "image.png" );
	//echo GetMeanRGB($image);
	
	header(  "Content-Type: image/png");
	imagepng( $image );
	imagedestroy( $image );
?>