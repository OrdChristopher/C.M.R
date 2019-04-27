<?php
	// standards test: https://en.wikipedia.org/wiki/Electric_car_use_by_country
	
	class data
	{
		private $chunks = array ( );
		
		public function process_symbols_lines ( $input )
		{
			// Input lenth is needed for later percentages.
			$input_length = strlen ( $input );
			$input_center = $input_length / 2;
			// Average chunk length is needed for later paercentages.
			$average_chunk_length = 0;
			// Split apart all input around whitespace characters.
			$chunks = preg_split ( '/([\r?\n|\r])|([$-\/:-?{-~!"^_`\[\]])/', $input, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE );
			$chunk_size = sizeof ( $chunks );
			$chunk_center = round ( $chunk_size / 2 );
			// Iterate our new input chunks.
			foreach ( $chunks as $index => $data )
			{
				$chunk = $data [ 0 ];
				$this->process_chunks ( $chunk );
			}
		}
		
		public function process_chunks ( $input )
		{
			// Input lenth is needed for later percentages.
			$input_length = strlen ( $input );
			$input_center = $input_length / 2;
			// Average chunk length is needed for later paercentages.
			$average_chunk_length = 0;
			// Split apart all input around whitespace characters.
			$chunks = preg_split ( '/\s+/', $input, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE );
			$chunk_size = sizeof ( $chunks );
			$chunk_center = round ( $chunk_size / 2 );
			// Iterate our new input chunks.
			foreach ( $chunks as $index => $data )
			{
				$chunk = $data [ 0 ];
				$offset = $data [ 1 ];
				$length = strlen ( $chunk );
				$before = $offset / $input_length;
				$after = ( $input_length - ( $offset + $length ) ) / $input_length;
				$rate = 1 / ( $chunk_size + 1 );
				$input_length_percent = $length / $input_length;
				$input_center_percent = abs ( $input_center - $offset ) / $input_center;
				$chunk_size_percent = ( $index + 1 ) / $chunk_size;
				$chunk_center_percent = abs ( $chunk_center - ( $index + 1 ) ) / $chunk_center;
				$length_percent_range = abs ( $input_length_percent - $chunk_size_percent );
				$center_percent_range = abs ( $input_center_percent - $chunk_center_percent );
				$rate_percent_range = ( $rate + $chunk_size_percent ) / 2;
				$fibonacci = $this->is_fibonacci_number ( $index ) ? 1 : 0;
				$perfect_square = $this->is_perfect_square ( $index ) ? 1 : 0;
				$relativity = ( ( ( 1 - $before ) + ( 1 - $after ) + abs ( 0.5 - $input_center_percent  ) + $rate ) / 4 );
				if ( !isset ( $this->chunks [ $chunk ] ) )
				{
					$this->chunks [ $chunk ] = array (
						'id' => null,
						'offset' => $offset,
						'length' => $length,
						'before' => $before,
						'after' => $after,
						'rate' => $rate,
						'input_length_percent' => $input_length_percent,
						'input_center_percent' => $input_center_percent,
						'chunk_size_percent' => $chunk_size_percent,
						'chunk_center_percent' => $chunk_center_percent,
						'length_percent_range' => $length_percent_range,
						'center_percent_range' => $center_percent_range,
						'rate_percent_range' => $rate_percent_range,
						'fibonacci' => $fibonacci,
						'perfect_square' => $perfect_square,
						'relativity' => $relativity,
					);
				}
				else
				{
					$last = $this->chunks [ $chunk ];
					$this->chunks [ $chunk ] = array (
						'id' => null,
						'offset' => ( $last [ 'offset' ] + $offset ) / 2,
						'length' => ( $last [ 'length' ] + $length ) / 2,
						'before' => ( $last [ 'before' ] + $before ) / 2,
						'after' => ( $last [ 'after' ] + $after ) / 2,
						'rate' => ( $last [ 'rate' ] + $rate ) / 2,
						'input_length_percent' => ( $last [ 'input_length_percent' ] + $input_length_percent ) / 2,
						'input_center_percent' => ( $last [ 'input_center_percent' ] + $input_center_percent ) / 2,
						'chunk_size_percent' => ( $last [ 'chunk_size_percent' ] + $chunk_size_percent ) / 2,
						'chunk_center_percent' => ( $last [ 'chunk_center_percent' ] + $chunk_center_percent ) / 2,
						'length_percent_range' => ( $last [ 'length_percent_range' ] + $length_percent_range ) / 2,
						'center_percent_range' => ( $last [ 'center_percent_range' ] + $center_percent_range ) / 2,
						'rate_percent_range' => ( $last [ 'rate_percent_range' ] + $rate_percent_range ) / 2,
						'fibonacci' => ( $last [ 'fibonacci' ] + $fibonacci ) / 2,
						'perfect_square' => ( $last [ 'perfect_square' ] + $perfect_square ) / 2,
						'relativity' => ( $last [ 'relativity' ] + $relativity ) / 2,
					);
				}
				$this->process_units ( $chunk );
			}
			//var_dump ( $this->chunks );
		}
		
		public function process_units ( $input )
		{
			//probability
			//proba b ility
			
			//prob ability
			//probabi lity
			// Input lenth is needed for later percentages.
			$unit_length = $input_length = strlen ( $input );
			
			$first_unit = $input [ 0 ];
			$last_unit = $input [ ( $input_length - 1 ) ];
			$units = array ( $input );
			while ( $unit_length > 4 )
			{
				foreach ( $units as $index => $unit )
				{
					$unit_length = strlen ( $unit );
					if ( $unit_length > 3 )
					{
						if ( ( $unit_length % 2 ) == 0 )
						{
							// Input length is even.
							$sub_unit_length = ( $unit_length / 2 );
							$pre = substr ( $unit, 0, $sub_unit_length );
							$post = substr ( $unit, $sub_unit_length, $sub_unit_length );
							$even_pre = substr ( $unit, 0, ( $sub_unit_length + $sub_unit_length ) );
							$even_post = substr ( $unit, ( $sub_unit_length - $sub_unit_length ), $unit_length );
							!in_array ( $pre, $units ) && ( $units [ ] = $pre ) && $this->add_chunk ( $pre, $input_length, sizeof ( $units ), 0 );
							!in_array ( $post, $units ) && ( $units [ ] = $post ) && $this->add_chunk ( $post, $input_length, sizeof ( $units ), $sub_unit_length );
							!in_array ( $even_pre, $units ) && ( $units [ ] = $even_pre ) && $this->add_chunk ( $even_pre, $input_length, sizeof ( $units ), 0 );
							!in_array ( $even_post, $units ) && ( $units [ ] = $even_post ) && $this->add_chunk ( $even_post, $input_length, sizeof ( $units ), ( $sub_unit_length - 1 ) );
						}
						else
						{
							$sub_unit_length = ( ( $unit_length + 1 ) / 2 );
							$pre = substr ( $unit, 0, $sub_unit_length );
							$post = substr ( $unit, 0, ( $sub_unit_length + 1 ) );
							$odd_pre = substr ( $unit, ( $unit_length - $sub_unit_length ), $sub_unit_length );
							$odd_post = substr ( $unit, ( $unit_length - $sub_unit_length - 1 ), ( $sub_unit_length + 1 ) );
							!in_array ( $pre, $units ) && ( $units [ ] = $pre ) && $this->add_chunk ( $pre, $input_length, sizeof ( $units ), 0 );
							!in_array ( $post, $units ) && ( $units [ ] = $post ) &&  $this->add_chunk ( $post, $input_length, sizeof ( $units ), 0 );
							!in_array ( $odd_pre, $units ) && ( $units [ ] = $pre ) && $this->add_chunk ( $odd_pre, $input_length, sizeof ( $units ), ( $unit_length - $sub_unit_length ) );
							!in_array ( $odd_post, $units ) && ( $units [ ] = $post ) &&  $this->add_chunk ( $odd_post, $input_length, sizeof ( $units ), ( $unit_length - $sub_unit_length - 1 ) );
						}
					}
				}
			}
		}
		
		public function add_chunk ( $chunk, $input_length, $chunk_size, $offset = 0, $index = 0 )
		{
			//$offset = $data [ 1 ];
			$length = strlen ( $chunk );
			$input_center = $input_length / 2;
			$chunk_center = round ( $chunk_size / 2 );
			$before = $offset / $input_length;
			$after = ( $input_length - ( $offset + $length ) ) / $input_length;
			$rate = 1 / ( $chunk_size + 1 );
			$input_length_percent = $length / $input_length;
			$input_center_percent = abs ( $input_center - $offset ) / $input_center;
			$chunk_size_percent = ( $index + 1 ) / $chunk_size;
			$chunk_center_percent = abs ( $chunk_center - ( $index + 1 ) ) / $chunk_center;
			$length_percent_range = abs ( $input_length_percent - $chunk_size_percent );
			$center_percent_range = abs ( $input_center_percent - $chunk_center_percent );
			$rate_percent_range = ( $rate + $chunk_size_percent ) / 2;
			$fibonacci = $this->is_fibonacci_number ( $index ) ? 1 : 0;
			$perfect_square = $this->is_perfect_square ( $index ) ? 1 : 0;
			$relativity = ( ( ( 1 - $before ) + ( 1 - $after ) + abs ( 0.5 - $input_center_percent  ) + $rate ) / 4 );
			if ( !isset ( $this->chunks [ $chunk ] ) )
			{
				$this->chunks [ $chunk ] = array (
					'id' => null,
					'offset' => $offset,
					'length' => $length,
					'before' => $before,
					'after' => $after,
					'rate' => $rate,
					'input_length_percent' => $input_length_percent,
					'input_center_percent' => $input_center_percent,
					'chunk_size_percent' => $chunk_size_percent,
					'chunk_center_percent' => $chunk_center_percent,
					'length_percent_range' => $length_percent_range,
					'center_percent_range' => $center_percent_range,
					'rate_percent_range' => $rate_percent_range,
					'fibonacci' => $fibonacci,
					'perfect_square' => $perfect_square,
					'relativity' => $relativity,
				);
			}
			else
			{
				$last = $this->chunks [ $chunk ];
				$this->chunks [ $chunk ] = array (
					'id' => null,
					'offset' => ( $last [ 'offset' ] + $offset ) / 2,
					'length' => ( $last [ 'length' ] + $length ) / 2,
					'before' => ( $last [ 'before' ] + $before ) / 2,
					'after' => ( $last [ 'after' ] + $after ) / 2,
					'rate' => ( $last [ 'rate' ] + $rate ) / 2,
					'input_length_percent' => ( $last [ 'input_length_percent' ] + $input_length_percent ) / 2,
					'input_center_percent' => ( $last [ 'input_center_percent' ] + $input_center_percent ) / 2,
					'chunk_size_percent' => ( $last [ 'chunk_size_percent' ] + $chunk_size_percent ) / 2,
					'chunk_center_percent' => ( $last [ 'chunk_center_percent' ] + $chunk_center_percent ) / 2,
					'length_percent_range' => ( $last [ 'length_percent_range' ] + $length_percent_range ) / 2,
					'center_percent_range' => ( $last [ 'center_percent_range' ] + $center_percent_range ) / 2,
					'rate_percent_range' => ( $last [ 'rate_percent_range' ] + $rate_percent_range ) / 2,
					'fibonacci' => ( $last [ 'fibonacci' ] + $fibonacci ) / 2,
					'perfect_square' => ( $last [ 'perfect_square' ] + $perfect_square ) / 2,
					'relativity' => ( $last [ 'relativity' ] + $relativity ) / 2,
				);
			}
		}

		public function is_perfect_square ( $number )
		{
			return ( pow ( sqrt ( $number ), 2 ) == $number );
		}

		public function is_fibonacci_number ( $number )
		{
			$number = 5 * pow ( $number, 2 );
			return $this->is_perfect_square ( $number + 4 ) || $this->is_perfect_square ( $number - 4 );
		}
		
		public function get_chunks ( )
		{
			return $this->chunks;
		}
	}
	( $data = new data ( ) );
	( !empty ( $_POST [ 'data' ] ) && ( $data->process_symbols_lines ( $_POST [ 'data' ] ) ) );
	var_dump ( $data->get_chunks ( ) );
?>
<form method="post">
	<textarea name="data"></textarea>
	<input type="submit">
</form>
	