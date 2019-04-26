<?php
	class Hashtag
	{
		public $Name;
		public $Id;
		public $Media_Count;
		
		public function __construct( $hashtag_array )
		{
			$this->Name = strval( $hashtag_array->name );
			$this->Id = intval( $hashtag_array->id );
			$this->Media_Count = intval( $hashtag_array->media_count );
		}
		
		public function ToArray( )
		{
			return array (
				"Name" => $this->Name,
				"Id" => $this->Id,
				"Media_Count" => $this->Media_Count
			);
		}
	}
?>