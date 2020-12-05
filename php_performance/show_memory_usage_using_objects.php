<?php

// Creates a new .csv file.
  $file = fopen('results_memory_consumption.csv', 'a');

// Puts the headers for columns in file.
  $columns = ['Number of objects', 'Memory consumption'];
  fputcsv($file, $columns);


// Basic class for testing.
  class Foo
  {
     public $var = '3.14159265359';
  }


// Gets the initial memory consumption.
  $baseMemory = memory_get_usage();

// Inits the loop.
  for ( $i = 0; $i <= 100000; $i++ )
  {
      $a = new Foo;
      $a->self = $a;
      
      // Get current memory usage and loads it in csv file.
      $current_memory_usage = formatBytes(memory_get_usage() - $baseMemory);
      fputcsv($file, [$i, $current_memory_usage]);

      if ( $i % 500 === 0 )
      {
  	// Every 500 items print the current memory consumption.
        echo sprintf( '%8d: ', $i ), $current_memory_usage, "\n";
      }
  }

// Closing the .csv file.
  fclose($file);

// Support function for modelling the output of memory values
  function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
  }
