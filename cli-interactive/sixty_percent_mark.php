<?php

/* Calculates whether a student is due full aid based on start / end dates for term */
// TODO: make a version that generates the sixty percent marks for all terms from a database table

// Define term constant for date comparison
define('TERM_LENGTH', 56);

// Enter the term start date (in any strtotime() format)
echo "Enter the term start date: " . PHP_EOL;
// Interactive shell - https://stackoverflow.com/questions/5794030
// TODO: this should probably be wrapped in a try/catch block
$term_start = date_create(fgets(STDIN));
echo PHP_EOL;
//var_dump($term_start);

// Round up to nearest whole number of days
$num_days = ceil(TERM_LENGTH * 0.6);

echo "Number of days to add: " . $num_days . PHP_EOL;

// Get the second date
// http://php.net/manual/en/datetime.modify.php
$sixty_percent_date = date_add_days($term_start, $num_days);

if($sixty_percent_date != FALSE && is_a($sixty_percent_date, 'DateTime')) {
  echo "Sixty percent mark in term: " . $sixty_percent_date->format('m/d/Y') . PHP_EOL;
}
// If input is not valid, dump for debugging
else {
  var_dump($sixty_percent_date);
}

// Wrapper function for DateTime::modify to add days
function date_add_days(DateTime $date, $num_days) {
  // Convert to string
  $add_string = '';
  if($num_days == 1) {
    $add_string = '+1 day';
  }
  else if($num_days > 1) {
	$add_string = '+' . (string) $num_days . ' days';
  }
  // If there's days to add, add them
  if($add_string != '') {
    $new_date = $date->modify($add_string);
  }
  // Return FALSE on bad input
  else {
	$new_date = FALSE;
  }
  //echo $add_string;
  return $new_date;
}