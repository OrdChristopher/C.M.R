<?php
	require_once ( 'bel/pearl-hypertext-processing.php' );
	require_once ( 'bel/typing.php' );
	require_once ( 'data/pdo/data.pdo.php' );
	require_once ( 'data/pdo/unicode.data.pdo.php' );
	
	$unicode = new unicode ( 'localhost', 'assumed_meridians', 'root', 'root', 'unicode' );
	
	$line = '0000;<control>;Cc;0;BN;;;;;N;NULL;;;;'; //FROM;DATA/UnicodeData.txt;READ-LINE;1
	
	$row = $unicode->type_as_data ( 'data/txt/UnicodeData.txt', 1 );
	
?>