<?php

// Creates a new .csv file.
  $file = fopen('results_memory_consumption_objects.csv', 'a');

// Puts the headers for columns in file.
  $columns = ['Number of objects', 'Memory consumption'];
  fputcsv($file, $columns);


// Basic class for testing.
  class Foo
  {
     public $var = 'Lorem fistrum por la gloria de mi madre por la gloria de mi madre apetecan jarl. 
                    A wan condemor te voy a borrar el cerito ese hombree pecador benemeritaar ahorarr. 
                    Papaar papaar mamaar  condemor va usté muy cargadoo a gramenawer jarl caballo blanco caballo negroorl torpedo apetecan la caidita. 
                    No puedor se calle ustée jarl condemor me cago en tus muelas de la pradera está la cosa muy malar se calle ustée a wan diodenoo. 
                    Hasta luego Lucas pupita a peich a peich mamaar hasta luego Lucas al ataquerl mamaar sexuarl fistro. 
                    Benemeritaar no puedor la caidita amatomaa ahorarr torpedo me cago en tus muelas está la cosa muy malar quietooor me cago en tus muelas.';
  }


// Gets the initial memory consumption.
  $baseMemory = memory_get_usage();

// Inits the loop.
  for ( $i = 0; $i <= 100000; $i++ )
  {
      $a = new Foo;
      $a->self = $a;
      
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
