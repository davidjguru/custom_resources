<?php

/*
 * First: Playing with the most basic Array figure: Dynamic Structure.
 */
 
  // Take the first memory value.
  $start_memory = memory_get_usage();

  // Get the converted value in the next unit.
  $start_memory_formatted = formatBytes($start_memory);

  // Show initial value of memory.
  echo "Initial memory: " . $start_memory_formatted ."\n";

  // Create a new array of 100K elements.
  $array = range(1,100000);

  // Now get the current memory value.
  $end_memory = memory_get_usage();

  // Convert value. 
  $end_memory_formatted = formatBytes($end_memory);

  // Show the final value.
  echo "Final memory: " . $end_memory_formatted . "\n";

  // Get the value of memory used in the generated array.
  $used_memory = ($end_memory - $start_memory);

  // Show the used value of memory.
  echo "Memory Usage: " . formatBytes($used_memory) . "\n\n";

/*
 * Second: Memory consumption with fixed length arrays.
 */
  // Take the first memory value.
  $start_memory_fixed = memory_get_usage();
  
  // Get the converted value in the next unit.
  $start_memory_fixed_formatted = formatBytes($start_memory_fixed);
  
  // Show initial value of memory.
  echo "Initial memory for Fixed Array: " . $start_memory_fixed_formatted ."\n";
  
  // Fullfilling the fixed array.
  $fixed_array = new SplFixedArray(100000);
    for ($i = 0; $i < 100000; ++$i) {
      $fixed_array[$i] = $i;
  }
  
  // Now get the current memory value.
  $end_memory_fixed = memory_get_usage();

  // Convert value. 
  $end_memory_fixed_formatted = formatBytes($end_memory_fixed);

  // Show the final value.
  echo "Final memory for Fixed Array: " . $end_memory_fixed_formatted . "\n";

  // Get the value of memory used in the generated array.
  $used_memory_fixed = ($end_memory_fixed - $start_memory_fixed);

  // Show the used value of memory.
  echo "Memory Usage for Fixed Arrays: " . formatBytes($used_memory_fixed) . "\n\n";
 
 // Support function for modelling the output of memory values
  function formatBytes($bytes, $precision = 2) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
  }
