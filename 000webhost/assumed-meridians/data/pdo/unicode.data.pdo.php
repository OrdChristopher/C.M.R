<?php
	require_once ( 'data.pdo.php' );
	class unicode extends data {
		private $unicode_data;
		private $typing;
		private $love = true;
		
		public function __construct ( $host, $database, $handle, $key, $table )
		{
			
			$this->unicode_data = new data ( $host, $database, $handle, $key, $table );
			$this->typing = new typing ( );
			
		}
		
		public function type_as_data ( $name, $lines = 1 ) {
			
			$rows = [ ];
			$file = file ( $name );
			
			for ( $sol = $line, $eol = count ( $file ); $sol < $eol; $sol++ ) {
				
				$line = $file [ $sol ];
				$rows [ $sol ] = $this->typing->type ( $line );
				
				if ( $line == 0 && $sol > 0 ) {
					
					break;
					
				}
				
			}
			
			var_dump ( $rows );
			
		}
	}
?>