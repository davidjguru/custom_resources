<?php

// Creates a new .csv file.
  $file = fopen('results_memory_consumption_variables.csv', 'a');

// Puts the headers for columns in file.
  $columns = ['Number of variables', 'Memory consumption'];
  fputcsv($file, $columns);


// Unique variable.
   $memory_first = memory_get_usage();
   $var = 'Lorem fistrum por la gloria de mi madre por la gloria de mi madre apetecan jarl.';
   echo 'Length of the string contained in the initial variable: ' . strlen($var), "\n";
   echo 'Initial Memory consumption, non-real in bytes:  ' . (memory_get_usage() - $memory_first) , "\n";
   echo 'Initial Memory consumption, non-real in bits: ' . ((memory_get_usage() - $memory_first) * 8), "\n"; 
   echo 'Initial variable size, STRLEN in bytes: ' . strlen($var) , "\n";
   echo 'Initial variable size, using bits: ' . (strlen($var) * 8) , "\n";

// Gets the initial memory consumption.
  $baseMemory = memory_get_usage();

// Inits the loop.
  for ( $i = 0; $i <= 100000; $i++ )
  {
      ${'variable_iteration_' . $i} = $var;
      
      // Gets current memory usage and loads it in csv file.
      $current_memory_usage = memory_get_usage() - $baseMemory;
      fputcsv($file, [$i, $current_memory_usage]);

      if ( $i % 500 === 0 )
      {
  	// Every 500 items prints in prompt the current memory consumption.
        echo sprintf( '%8d: ', $i ), formatBytes($current_memory_usage), "\n";
      }
  }

// Closing the .csv file.
  fclose($file);

// Support function for modelling the output of memory values
  function formatBytes($bytes, $precision = 2) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
  }
