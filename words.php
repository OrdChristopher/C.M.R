<?php

  if(isset($_REQUEST['words']))
  {
    $words = str_split ( strtolower ( $_REQUEST['words'] ) );
    //currently one words
    /*for($index = 0, $max = strlen ( $words ); $index < $max; $index++)
    {

    }*/
    $maximum = sizeof ( $words );

    if ( $maximum > 1 )
    {
      for($index = 0; $index < $maximum; $index++)
      {
        $words [ $index ] = ord ( $words [ $index ] ) - 97;
      }

      $last_char = array_pop ( $words );
      $first_char = array_shift ( $words );

      if ( $first_char > $last_char )
      {
        $first_last_order = 'arsort';
        $x1 = $maximum - 1;
        $x2 = 0;
        $y1 = $last_char;
        $y2 = $first_char;
      }
      else
      {
        $first_last_order = 'asort';
        $x1 = 0;
        $x2 = $maximum - 1;
        $y1 = $first_char;
        $y2 = $last_char;
      }

      call_user_func_array ( $first_last_order, array( &$words ) );
      print_r($words);

      $slope = ( $y1 - $y2 ) / ( $x1 - $x2 );
      echo "{$first_char} {$last_char} ";
      echo "slope {$slope} ";

      $y_intercept = $y1 - ( $slope * $x1 ); // y=mx+b; y-mx=b
      echo "y-intercept {$x2} ";
      echo "line y={$slope}x+{$y_intercept}";
      //ax^2 + bx + c
      quadratic ( $words );
    }
  }

?>
<!DOCTYPE html>
<html>
  <head>
  </head>

  <body>
    <form method="post">
      <input type="text" name="words" />
      <input type="submit" value="parse" />
    </form>
  </body>
</html>
