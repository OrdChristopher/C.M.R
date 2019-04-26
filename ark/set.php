<?php
	class set {
		private $rise = null;
		
		public function __construct ( $value = null ) {
			$this->rise = $value;
		}
		
		public function to ( $value, $from = 'json', $to = 'php' ) {
			/*
				https://stackoverflow.com/questions/6384431/creating-anonymous-objects-in-php
				
				var object = { 
					p : "value", 
					p1 : [ "john", "johnny" ] } ;
				
				https://www.php.net/manual/en/json.constants.php
			*/
			switch ( $from ) {
				case "json":
					$json_last_exception = null;
					$json_last_error = 0;
					try {
						$value = json_decode ( $value, true, 512 );
						$json_last_error = json_last_error ( );
					} catch ( JsonException $json_exception ) {
						$json_last_exception = $json_exception;
					}
				break;
				default:
					echo 'SET value TO to FROM from.';
				break;
			}
			return $this->object_result ( $value );
		}
		
		public function from ( $value, $to, $from ) {
			
			return $this->object_result ( $value );
		}
		
		public function object_result ( $value ) {
			return $value;
		}
	}
	
	$set = new set ( );
	var_dump ( $set->to ( '{"test":"h"}', 'json', 'php' ) );