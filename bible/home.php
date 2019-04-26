<?php
	
	require_once ( "genesis/verse/one-five/pearl-hypertext-processing.php" );
	require_once ( "ecclesiastes/verse/one-sixteen/typing.php" );
	
	$alphabetic_numeric_seperated_values = 'c1v1c2v2c3bb';
	
	$seperate_values = typing::typed ( $alphabetic_numeric_seperated_values );
	
	var_dump ( $seperate_values );
	
?>