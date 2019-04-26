<?php

  require ( "directoryFolderFile.php" );
  
  $directoryFolderFile = new directoryFolderFile ( );
  
  require ( "cluster.php" );
  
  $cluster = new cluster ( $_GET [ 'cluster' ] );
  
  var_export ( $cluster );