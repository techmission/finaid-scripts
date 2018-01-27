<?php

/* Calculates whether a student is due full aid based on start / end dates for term */
// TODO: make a version that generates a report directly from Populi (using API framework)

// Define term constant for date comparison
define('TERM_LENGTH', 56);

// Enter the dates (in any strtotime() format)
echo "Enter the first date: " . PHP_EOL;
// Interactive shell - https://stackoverflow.com/questions/5794030
// TODO: this should probably be wrapped in a try/catch block
$datetime1 = date_create(fgets(STDIN));
echo "Enter the second date: " . PHP_EOL;
$datetime2 = date_create(fgets(STDIN));
echo PHP_EOL;
//var_dump(array($datetime1, $datetime2));

// Do calculations
$interval = $datetime1->diff($datetime2);
// Get day difference - http://php.net/manual/en/datetime.diff.php
// Add 1 since that is how the R2T4 formula works
$days = $interval->d + 1;
// Get the percent of term completed (to 2 decimal points)
$term_percent = ($days / TERM_LENGTH) * 100;

// Output results
echo "Date difference & aid percent:" . PHP_EOL;
echo "------------------------------" . PHP_EOL;
echo $interval->format('%R%a days') . PHP_EOL;

echo $term_percent . "%" . PHP_EOL;

if($term_percent >= 60) {
  echo "Due full aid." . PHP_EOL;
}
else {
  echo "Due partial aid."  . PHP_EOL;
}

